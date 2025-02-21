use App\Models\User;

test('profile page is displayed', function () {
$user = User::factory()->create();

$response = $this
->actingAs($user)
->get('/profile');

$response->assertOk();
});

test('profile information can be updated', function () {
$user = User::factory()->create();

$response = $this
->actingAs($user)
->patch('/profile', [
'name' => 'Test User',
]);

$response
->assertSessionHasNoErrors()
->assertRedirect('/profile');

$user->refresh();

$this->assertSame('Test User', $user->name);
$this->assertSame($user->email, 'test@example.com');
});

test('user can delete their account', function () {
$user = User::factory()->create();

$response = $this
->actingAs($user)
->delete('/profile', [
'password' => 'password',
]);

$response
->assertSessionHasNoErrors()
->assertRedirect('/');

$this->assertGuest();
$this->assertNull($user->fresh());
});

test('correct password must be provided to delete account', function () {
$user = User::factory()->create();

$response = $this
->actingAs($user)
->from('/profile')
->delete('/profile', [
'password' => 'wrong-password',
]);

$response
->assertSessionHasErrors('password')
->assertRedirect('/profile');

$this->assertNotNull($user->fresh());
});
