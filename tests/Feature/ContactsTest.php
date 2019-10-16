<?php

namespace Tests\Feature;

use App\Contact;
use App\User;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;



class ContactsTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function an_unauthenticated_user_should_be_redirected_to_login()
    {
        // $this->withoutExceptionHandling();

        $response = $this->post('/api/contacts', array_merge($this->data(), ['api_token' => '']));

        $response->assertRedirect('/login');
        $this->assertCount(0, Contact::all());
    }

    /** @test */
    public function an_authenticated_user_can_add_a_contact()
    {
        $this->withoutExceptionHandling();
        $response = $this->post(
            '/api/contacts',
            array_merge($this->data(), ['user_id' => $this->user->id])
        );

        $contact = Contact::first();

        $this->assertCount(1, Contact::all());
        $this->assertEquals('Amit Joshi', $contact->name);
        $this->assertEquals('amit@amitlara.com', $contact->email);
        $this->assertEquals('123456789', $contact->phone);
        // $this->assertEquals('1977-12-13', $contact->birthday);
        $this->assertEquals('AmitLara.com', $contact->company);

        $response->assertStatus(201);
    }

    /** @test */
    public function birthdays_are_properly_stored()
    {
        $this->withoutExceptionHandling();
        $postedData = array_merge($this->data());
        $response = $this->post('/api/contacts', $postedData);
        $this->assertCount(1, Contact::all());
        // $this->assertEquals('1977-12-13', Carbon::parse(Contact::first()->birthday));
        $this->assertInstanceOf(Carbon::class, Contact::first()->birthday);
    }

    /** @test */
    public function an_email_must_be_a_valid_email()
    {
        $this->withoutExceptionHandling();
        $postedData = array_merge($this->data(), ['email' => 'INVALID EMAIL']);
        $response = $this->post('/api/contacts', $postedData);
        $response->assertSessionHasErrors('email');
        $this->assertCount(0, Contact::all());
    }


    /** @test */
    public function fields_are_required()
    {
        $this->withoutExceptionHandling();
        $fields = collect(['name', 'email', 'phone', 'birthday', 'company']);
        $fields->each(function ($field) {
            $postedData = array_merge($this->data(), [$field => '']);
            $response = $this->post('/api/contacts', $postedData);
            $response->assertSessionHasErrors($field);
            $this->assertCount(0, Contact::all());
        });
    }
    private function data()
    {
        return [
            'name' => 'Amit Joshi',
            'email' => 'amit@amitlara.com',
            'phone' => '123456789',
            'birthday' => '1977-12-13',
            'company' => 'AmitLara.com',
            'api_token' => $this->user->api_token,
        ];
    }

    /** @test */
    public function a_contact_can_be_retrieved()
    {
        $this->withoutExceptionHandling();

        $contact = factory(Contact::class)->create(['user_id' => $this->user->id]);

        $response = $this->get('/api/contact/' . $contact->id . '?api_token=' . $this->user->api_token);
        $response->assertJson([[
            'name' => $contact->name,
            'email' => $contact->email,
            'phone' => $contact->phone,
            'birthday' => $contact->birthday,
            'company' => $contact->company,
        ]]);
    }

    /** @test */
    public function a_contact_can_be_patched()
    {
        $this->withoutExceptionHandling();

        $contact = factory(Contact::class)->create();

        $response = $this->patch('/api/contact/' . $contact->id, $this->data());

        $contact->fresh();

        $this->assertCount(1, Contact::all());
    }

    /** @test */
    public function a_contact_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        $contact = factory(Contact::class)->create();

        $response = $this->delete('/api/contact/' . $contact->id, ['api_token' => $this->user->api_token]);

        $contact->fresh();

        $this->assertCount(0, Contact::all());
    }

    /** @test */
    public function a_list_of_contacts_can_be_fetched_for_the_authenticated_users()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $anotherUser = factory(User::class)->create();

        $contact = factory(Contact::class)->create(['user_id' => $user->id]);
        $anotherContact = factory(Contact::class)->create(['user_id' => $anotherUser->id]);

        $response = $this->get('/api/contacts?api_token=' . $this->user->api_token);

        $response->assertJsonCount(1);
    }
}
