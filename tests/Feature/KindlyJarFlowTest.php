<?php

namespace Tests\Feature;

use App\Models\Campaign;
use App\Models\DigitalProduct;
use App\Models\FundraiserVerification;
use App\Models\Transaction;
use App\Models\User;
use App\Models\WithdrawalRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KindlyJarFlowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    public function test_guest_can_view_landing_page(): void
    {
        $this->get(route('home'))->assertOk();
    }

    public function test_user_can_register_and_login(): void
    {
        $this->post(route('register'), [
            'legal_name'            => 'Tes User Baru',
            'email'                 => 'baru@kindlyjar.com',
            'password'              => 'password123',
            'password_confirmation' => 'password123',
        ])->assertRedirect(route('dashboard'));

        $this->assertAuthenticated();

        $this->post(route('logout'));

        $this->post(route('login'), [
            'email'    => 'baru@kindlyjar.com',
            'password' => 'password123',
        ])->assertRedirect(route('dashboard'));

        $this->assertAuthenticated();
    }

    public function test_savior_can_browse_shop_add_to_cart_and_checkout(): void
    {
        $user = User::where('email', 'joseph@gmail.com')->firstOrFail();
        $product = DigitalProduct::where('stock', '>', 0)->firstOrFail();
        $initialStock = $product->stock;

        $this->actingAs($user);

        $this->get(route('kindlyshop'))->assertOk();

        $this->post(route('keranjang.tambah', $product), ['quantity' => 1])
            ->assertRedirect()
            ->assertSessionHas('success');

        $this->assertDatabaseHas('cart_items', [
            'product_id' => $product->id,
            'quantity'   => 1,
        ]);

        $this->post(route('keranjang.checkout'), [
            'extra_donation' => 5000,
            'bank_name'      => 'BCA',
        ])
            ->assertRedirect(route('riwayat'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('transactions', [
            'buyer_id'    => $user->id,
            'campaign_id' => $product->campaign_id,
            'status'      => 'success',
        ]);

        $product->refresh();
        $this->assertSame($initialStock - 1, $product->stock);
    }

    public function test_savior_can_donate_to_campaign(): void
    {
        $user = User::where('email', 'dinda@gmail.com')->firstOrFail();
        $campaign = Campaign::firstOrFail();
        $before = $campaign->collected_amount;

        $this->actingAs($user)
            ->post(route('donasi.store', $campaign), [
                'nominal'   => 25000,
                'bank_name' => 'Mandiri',
            ])
            ->assertRedirect(route('detail-program', $campaign))
            ->assertSessionHas('success');

        $campaign->refresh();
        $this->assertSame($before + 25000, (float) $campaign->collected_amount);

        $this->assertTrue(
            Transaction::where('buyer_id', $user->id)
                ->where('campaign_id', $campaign->id)
                ->where('extra_donation', 25000)
                ->where('status', 'success')
                ->exists()
        );
    }

    public function test_non_admin_cannot_access_admin_panel(): void
    {
        $user = User::where('email', 'joseph@gmail.com')->firstOrFail();

        $this->actingAs($user)
            ->get(route('admin.dashboard'))
            ->assertForbidden();
    }

    public function test_admin_can_approve_pending_kyc(): void
    {
        $admin = User::where('email', 'admin@kindlyjar.com')->firstOrFail();
        $verification = FundraiserVerification::where('status', 'pending')->firstOrFail();
        $user = $verification->user;

        $this->actingAs($admin)
            ->post(route('admin.verifications.approve', $verification))
            ->assertRedirect()
            ->assertSessionHas('success');

        $verification->refresh();
        $user->refresh();

        $this->assertSame('verified', $verification->status);
        $this->assertSame('verified', $user->kyc_status);
    }

    public function test_admin_can_approve_pending_withdrawal(): void
    {
        $admin = User::where('email', 'admin@kindlyjar.com')->firstOrFail();
        $withdrawal = WithdrawalRequest::where('status', 'pending')->firstOrFail();
        $fundraiser = $withdrawal->wallet->user;
        $campaign = $fundraiser->campaigns()->firstOrFail();
        $beforeWithdrawn = $campaign->withdrawn_amount;

        $this->actingAs($admin)
            ->post(route('admin.withdrawals.approve', $withdrawal))
            ->assertRedirect()
            ->assertSessionHas('success');

        $withdrawal->refresh();
        $campaign->refresh();

        $this->assertSame('approved', $withdrawal->status);
        $this->assertSame($beforeWithdrawn + (float) $withdrawal->amount, (float) $campaign->withdrawn_amount);
    }

    public function test_user_can_update_profile(): void
    {
        $user = User::where('email', 'rangga@gmail.com')->firstOrFail();

        $this->actingAs($user)
            ->post(route('profil.update'), [
                'display_name' => 'Rangga Updated',
                'bio'          => 'Savior aktif KindlyJAR',
            ])
            ->assertRedirect()
            ->assertSessionHas('success');

        $user->refresh();
        $this->assertSame('Rangga Updated', $user->display_name);
        $this->assertSame('Savior aktif KindlyJAR', $user->bio);
    }
}
