# Laravel notes

-   [Create a new Laravel project](#new-project)
-   [Hello world exercise](#hello-world-exercise)
-   [Route parameter exercise](#route-parameter-exercise)
-   [Controller exercise](#controller-exercise)
-   [View exercise](#view-exercise)
-   [Render list exercise](#render-list-exercise)
-   [Layout exercise](#layout-exercise)
-   [Register form](#register-form)
-   Ticketing system app
    -   [Installation](#clone-project)
    -   [Ticket model and migration](#ticket-model-and-migration)
    -   [Render tickets](#render-tickets)
    -   [Create ticket form](#create-ticket-form)
    -   [Create form errors](#create-form-errors)
    -   [Create form errors](#create-form-errors)
    -   [Show ticket view](#show-ticket-view)
    -   [Delete ticket](#delete-ticket)
    -   [Update ticket policy](#update-ticket-policy)
    -   [Reply model](#reply-model)
    -   [Reply model relationships](#reply-model-relationships)
    -   [Render replies](#render-replies)
    -   [Store reply](#store-reply)
    -   [Delete reply](#delete-reply)
    -   [Reply policy](#reply-policy)

### New project

`composer create-project --prefer-dist laravel/laravel name`

### Hello world exercise

Create a get route for the `hello` URL and return `Hello, world`.

#### Hints

-   Open routes/web.php
-   Use Route facade

```php
Route::get(url, closure);
```

<details><summary>Solution</summary>
<p>

```php
Route::get('hello', function() {
  return 'Hello, world';
});
```

</p>
</details>

### Route parameter exercise

-   Create `hello` get route and accept a `name` parameters as string
-   Return name parameter

#### Hints

-   Open routes/web.php
-   Use Route facade
-   Define `{name}` as parameter

<details><summary>Solution</summary>
<p>

```php
Route::get('hello/{name}', function(string $name) {
  return $name;
});
```

</p>
</details>

### Controller exercise

-   Generate a controller
-   Register a route that accepts two numbers as parameters
-   Return the sum of the parameters

#### Hints

-   `php artisan make:controller ControllerName`
-   Use Route facade
-   Define `{a}` and `{b}` as parameters

<details><summary>Solution</summary>
<p>

**terminal**

`php artisan make:controller ExampleController`

**routes/web.php**

```php
Route::get('{a}/{b}', 'ExampleController@sum');
```

**app/http/Controllers/ExampleController**

```php
public function sum(int $a, int $b) {
  return $a + $b;
}
```

</p>
</details>

### View exercise

#### Requirements

-   Create a get route and accept `name` as parameter
-   Return a view with and pass the name parameter
-   Render `Hello,` and the name

#### Hints

-   Use Route facade
-   Define `{name}` as parameter
-   Create a blade file inside `resources/views` folder
-   Return the blade file from the previous step using `view('view_name', ['name' => $name])` helper

<details><summary>Solution</summary>
<p>

**routes/web.php**

```php
Route::get('{name}', function(string $name) {
  return view('hello', ['name' => $name])
});
```

**resources/views/hello.blade.php**

```php
<h1>Hello, {{$name}}</h1>
```

</p>
</details>

### Render list exercise

#### Requirements

**Star Wars movies data**

```php
$starWarsMovies = [
    'Episode IV – A New Hope (1977)',
    'Episode V – The Empire Strikes Back (1980)',
    'Episode VI – Return of the Jedi (1983)',
    'Episode I – The Phantom Menace (1999)',
    'Episode II – Attack of the Clones (2002)',
    'Episode III – Revenge of the Sith (2005)',
    'Episode VII – The Force Awakens (2015)',
    'Episode VIII – The Last Jedi (2017)',
    'Episode IX – The Rise of Skywalker (2019)',
];
```

-   Create a blade template and render `Star Wars movies`
-   Create a route, return the template and pass Star wars movies
-   Use unordered list element `ul`
-   Render iteration number before each movie
-   Add `first-movie` class on the first movie
-   Render last movie inside a `strong` element

#### Hints

-   Use Route facade
-   Define `{name}` as parameter
-   Create a blade file inside `resources/views` folder
-   Return the blade file from the previous step using `view('view_name', ['name' => $name])` helper
-   `@foreach($array as $item) @endforeach`
-   Use `$loop` variable inside foreach
    -   index
    -   iteration
    -   remaining
    -   first
    -   last

<details><summary>Solution</summary>
<p>

**routes/web.php**

```php
Route::get('movies', function() {
  $starWarsMovies = [
    'Episode IV – A New Hope (1977)',
    'Episode V – The Empire Strikes Back (1980)',
    'Episode VI – Return of the Jedi (1983)',
    'Episode I – The Phantom Menace (1999)',
    'Episode II – Attack of the Clones (2002)',
    'Episode III – Revenge of the Sith (2005)',
    'Episode VII – The Force Awakens (2015)',
    'Episode VIII – The Last Jedi (2017)',
    'Episode IX – The Rise of Skywalker (2019)',
];
  return view('movies', ['movies' => $starWarsMovies])
});
```

**resources/views/movies.blade.php**

```php
<ul>
@foreach($movies as $movie)
<li class="{{$loop->first ? 'first-movie' : ''}}">
  @if(!$loop->last)
  {{$loop->iteration}} - {{$movie}}
  @else
  <strong>{{$loop->iteration}} - {{$movie}}</strong>
  @endif
</li>
@endforeach
<ul>
```

</p>
</details>

### Layout exercise

#### Requirements

-   Create a view named `layout` and declare 2 sections
    -   title (Document title)
    -   content
-   Include Bootstrap using the CDN link
-   Create another view named `home`
    -   Extend `layout` view and override `title` and `content` sections
    -   Add a button inside `content` section with the classes `btn btn-primary`
-   Create a route and return the `home` view

#### Hints

-   `@yield('section_name')`
-   `@extends('view_name')`
-   `@section('section_name') @endsection`
-   Bootstrap: `<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">`

<details><summary>Solution</summary>
<p>

**resources/views/layout.blade.php**

```php
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <div>
        @yield('content')
    </div>
</body>

</html>
```

**resources/views/home.blade.php**

```php
@extends('layout')

@section('title', 'Home page')

@section('content')
<button class="btn btn-primary"></button>
@endsection

```

**routes/web.php**

```php
Route::get('home', function() {
  return view('home');
});
```

</p>
</details>

### Register form

#### Requirements

-   Create a controller named `RegisterController`
-   Create a view named `register`
-   Define a `/register` get and post routes
-   Form requirements
    -   Name field
    -   Email field
    -   Password field
    -   Password confirmation
    -   Action to `RegisterController@register`
    -   Form errors
    -   Old values
-   Implement registerForm method on `RegisterController` and return `register` view
-   Implement register method on `RegisterController`
    -   Validation
        -   Name rules -> Required, String, Max 50
        -   Email rules -> Required, String, Email, Max 255
        -   Password rules -> Required, Min 8, Confirmed
-   Create a view named `welcome` and render `Hello, {{$name}}`
-   Create a method on controller named `welcome`
-   Define a `/welcome/{name}` route
-   On succusfull registration redirect to `welcome` and pass the `name` as parameter

#### Hints

-   `php artisan make:controller ControllerName`
-   Use `Route` facade to define routes
-   `action('ControllerName@method')`
-   `@csrf`
-   Name attribute on form fields
-   `@method()`
-   `request->validate(['field_name' => 'rule1|rule2'])`
-   `redirect(url)`
-   `action('ControllerName@method', ['param' => $param])`

<details><summary>Solution</summary>
<p>

**routes/web.php**

```php
Route::get('/register', 'RegisterController@registerForm');
Route::post('/register', 'RegisterController@register');
Route::get('/welcome/{name}', 'RegisterController@welcome');
```

**app/Http/Controllers/RegisterController**

```php
class RegisterController extends Controller
{
    public function registerForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]
        );

        return redirect(action('RegisterController@welcome', ['name' => $validatedData['name']]));
    }

    public function welcome(string $name)
    {
        return view('welcome', ['name' => $name]);
    }
}
```

**resources/views/register.blade.php**

```php
<ul>
  @foreach($errors->all as $error)
  <li>{{$error}}</li>
  @endforeach
</ul>
<form action="{{action('RegisterController@register')}}" method="POST">
  @csrf
  <input type="text" name="name" placeholder="Name" value="{{old('name', '')}}">
  <input type="email" name="email" placeholder="Email" value="{{old('email', '')}}">
  <input type="password" name="password" placeholder="Password" value="{{old('password', '')}}">
  <input type="password" name="password_confirmation" placeholder="Password confirmation">
  <input type="submit" value="Register">
</form>
```

**resources/views/register.blade.php**

```php
<h1>Hello, {{$name}}</h1>
```

</p>
</details>

## Ticketing system

### Clone project

-   `git clone --branch installation https://github.com/SocialNerdsGR/laravel-workshop-ticketing-system.git ticketing-app`
-   `cd ticketing-app`
-   `chmod +x checkout.sh`
-   `cp .env.example .env`
-   `composer install`
-   `php artisan key:generate`
-   `touch database/database.sqlite`
-   `Change DB_CONNECTION variable on .env file from DB_CONNECTION=mysql to DB_CONNECTION=sqlite`

### Ticket model and migration

#### Requirements

-   Generate Model and Migration files using artisan
-   Ticket fields
    -   type: unsignedBigInteger, name: user_id (foreign key)
    -   type: string, name: title
    -   type: text, name: text
-   Create 2 tickets using `Tinker`
    -   Use `Ticket::create()` method
-   User relationship on Ticket model

#### Hints

-   `php artisan make:model Name --migration (-m)`
-   `foreign('field_name')->references('table_id')->on('table')`
-   `php artisan migrate`
-   `php artisan tinker`
-   `protected $fillable = ['field_name', 'field_name']`
-   `return $this->belongsTo(Model::class)`

<details><summary>Solution</summary>
<p>

**create_tickets_table.php**

```php
public function up()
{
  Schema::create('tickets', function (Blueprint $table) {
    $table->bigIncrements('id');
    $table->unsignedBigInteger('user_id');
    $table->foreign('user_id')->references('id')->on('users');
    $table->string('title');
    $table->text('content');
    $table->timestamps();
  });
}
```

**Ticket.php**

```php
class Ticket extends Model
{
  protected $fillable = ['title', 'content', 'user_id'];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
```

</p>
</details>

### Render tickets

#### Requirements

-   Create a new folder named `tickets` inside resources
-   Create `index.blade.php` file
-   Implement `index` method on TicketsController
    -   Load tickets using `paginate()` method
    -   Return `index` view passing tickets as parameter
-   Render tickets
    -   Extend app layout
    -   title -> link to /tickets/{ticketId} using `action` helper
    -   render pagination links using `links()` method

#### Hints

-   `Ticket::paginate(PER_PAGE)`
-   `view('view_name', ['key' => $value])`
-   `@extends('view_name')`
-   `@section('section_name') @endsection`
-   `@foreach`
-   `action('ControllerName@method', ['key' => $value])`

<details><summary>Solution</summary>
<p>

**TicketsController.php**

```php
public function index()
{
    $tickets = Ticket::paginate(10);
    return view('tickets.index', ['tickets' => $tickets]);
}
```

**resources/tickets/index.blade.php**

```php
@extends('layouts.app')

@section('content')
<h2>Tickets</h2>
<ul>
  @foreach($tickets as $ticket)
  <li><a href={{action('TicketsController@show', ['ticket' => $ticket->id])}}>{{$ticket->title}}</a></li>
  @endforeach
</ul>
{{$tickets->links()}}
@endsection
```

</p>
</details>

### Create Ticket form

#### Requirements

-   Create a link on `index.blade.php` targeting create method on TicketsController using `action` helper
-   Create `create.blade.php` inside tickets folder
-   Extend layout
-   Implement new ticket form
    -   form
    -   method
    -   action
    -   Title input
    -   Contnent textarea
    -   Submit button

#### Hints

-   `@extend('view_name')`
-   `action('ControllerName@method')`
-   `@csrf`
-   Name attribute on form fields

<details><summary>Solution</summary>
<p>

**resources/tickets/index.blade.php**

```php
<a href={{action('TicketsController@create')}}>Create new ticket</a>
```

**TicketsController.php**

```php
public function create()
{
    return view('tickets.create');
}
```

**resources/tickets/create.blade.php**

```php
@extends('layouts.app')

@section('content')
<form method="POST" action={{action('TicketsController@store')}}>
  @csrf
  <input type="text" name="title" placeholder="Title">
  <textarea placeholder="Ticket" name="content" cols="30" rows="10"></textarea>
  <input type="submit" value="Create">
</form>
@endsection
```

</p>
</details>

### Create form errors

#### Requirements

-   Render form errors
-   Fill old form values
-   Redirect to created ticket

#### Hints

-   Use `$errors` object to get errors
-   Use `old('field_name', defaultValue)` helper to get form values
-   Use `action` helper to generate a link

<details><summary>Solution</summary>
<p>

**resources/tickets/create.blade.php**

```php
@section('content')
<ul>
  @foreach($errors->all() as $error)
  <li>{{$error}}</li>
  @endforeach
</ul>
<form method="POST" action={{action('TicketsController@store')}}>
  @csrf
  <input value="{{old('title', '')}}" type="text" name="title" placeholder="Title">
  <textarea placeholder="Ticket" name="content" cols="30" rows="10">{{old('content', '')}}</textarea>
  <input type="submit" value="Create">
</form>
@endsection
```

**TicketsController.php**

```php
public function store(Request $request)
{
  $validatedData = $request->validate([
    'title' => 'required|min:5|unique:tickets',
    'content' => 'required|max:255'
  ]);

  $ticket = Ticket::create([
    'user_id' => Auth::user()->id,
    'title' => $validatedData['title'],
    'content' => $validatedData['content']
  ]);

  return redirect(action('TicketsController@show', ['ticket' => $ticket->id]));
}
```

</p>
</details>

### Show ticket view

#### Requirements

-   Create `show.blade.php` file
-   Implement `show` method on TicketsController
    -   Return `show` view passing ticket as parameter
-   Render ticket
    -   Title
    -   Content

#### Hints

-   `view('view_name', ['key' => $value])`
-   `@extends('view_name')`
-   `@section('section_name') @endsection`

<details><summary>Solution</summary>
<p>

**TicketsController.php**

```php
public function show(Ticket $ticket)
{
  return view('tickets.show', ['ticket' => $ticket]);
}
```

**resources/tickets/show.blade.php**

```php
@extends('layouts.app')

@section('content')
<h3>{{$ticket->title}}</h3>
<p>
  {{$ticket->content}}
</p>
@endsection
```

</p>
</details>

### Delete ticket

#### Requirements

-   Create delete form after ticket title on `show` view
-   Use delete method
-   Implement destroy method on `TicketsController`
-   Redirect back to `index`

#### Hints

-   `@method()`
-   `@csrf`
-   `$model->delete()`
-   `action('ControllerName@method')`

<details><summary>Solution</summary>
<p>

**resources/tickets/show.blade.php**

```php
<form method="POST" action="{{action('TicketsController@destroy', ['ticket' => $ticket->id])}}">
  @csrf
  @method('DELETE')
  <input type="submit" value="Delete">
</form>
```

**TicketsController.php**

```php
public function destroy(Ticket $ticket)
{
  $ticket->delete();
  return redirect(action('TicketsController@index'));
}
```

</p>
</details>

### Edit ticket

#### Requirements

-   Add edit link on `show` view
-   Create `edit.blade.php` file
-   Implement `edit` method on TicketsController
    -   Return `edit` view passing ticket as parameter
-   Render edit form
    -   Use `PATCH` method
    -   Title input
    -   Content
-   Render errors and old values
-   Validate and update ticket
-   Redirect to `show` method

#### Hints

-   `@extend('view_name')`
-   `action('ControllerName@method')`
-   `@csrf`
-   `@method()`
-   Name attribute on form fields
-   `request->validate(['field_name' => 'rule1|rule2'])`
-   `$model->update($validatedData)`

<details><summary>Solution</summary>
<p>

**resources/tickets/show.blade.php**

```php
<a href="{{action('TicketsController@edit', ['ticket' => $ticket->id])}}">Edit ticket</a>
```

**TicketsController.php**

```php
public function edit(Ticket $ticket)
{
  return view('tickets.edit', ['ticket' => $ticket]);
}
```

**resources/tickets/edit.blade.php**

```php
@extends('layouts.app')

@section('content')
<ul>
  @foreach($errors->all() as $error)
  <li>{{$error}}</li>
  @endforeach
</ul>
<form method="POST" action="{{action('TicketsController@update', ['ticket' => $ticket->id])}}">
  @csrf
  @method('PATCH')
  <input name="title" value="{{old('title', $ticket->title)}}" type="text">
  <textarea name="content" cols="30" rows="10">{{old('content', $ticket->content)}}</textarea>
  <input type="submit" value="Save">
</form>
@endsection
```

**TicketsController.php**

```php
public function update(Request $request, Ticket $ticket)
{
  $validatedData = request()->validate([
    'title' => 'required|min:5|unique:tickets,title,' . $ticket->id,
    'content' => 'required|max:255'
  ]);

  $ticket->fill($validatedData);
  $ticket->save();

  return redirect(action('TicketsController@edit', ['ticket' => $ticket->id]));
}
```

</p>
</details>

### Update ticket policy

#### Requirements

-   Implement `update` method on `TicketPolicy`
-   Render edit link on show view, only if user is authorized to update the ticket

#### Hints

-   `@can('model', $model)...@endcan`

<details><summary>Solution</summary>
<p>

**TicketPolicy.php**

```php
public function update(User $user, Ticket $ticket)
{
  return $user->id == $ticket->user_id;
}
```

**resources/tickets/show.blade.php**

```php
@can('update', $ticket)
<a href="{{action('TicketsController@edit', ['ticket' => $ticket->id])}}">Edit ticket</a>
@endcan
```

</p>
</details>

### Reply model

#### Requirements

-   Generate Model and Migration files using artisan
-   Reply fields
    -   type: unsignedBigInteger, name: user_id (foreign key)
    -   type: unsignedBigInteger, name: ticket_id (foreign key)
    -   type: text, name: reply
-   Create 2 replies using `Tinker`
    -   Use `Reply::create()` method

#### Hints

-   `php artisan make:model Name --migration (-m)`
-   `foreign('field_name')->references('table_id')->on('table')`
-   `php artisan migrate`
-   `php artisan tinker`
-   `protected $fillable = ['field_name', 'field_name']`

<details><summary>Solution</summary>
<p>

**Reply.php**

```php
class Ticket extends Model
{
    protected $fillable = ['title', 'content', 'user_id'];
}
```

**database/migrations/create_replies_table.php**

```php
Schema::create('replies', function (Blueprint $table) {
    $table->bigIncrements('id');
    $table->unsignedBigInteger('ticket_id');
    $table->foreign('ticket_id')->references('id')->on('tickets');
    $table->unsignedBigInteger('user_id');
    $table->foreign('user_id')->references('id')->on('users');
    $table->text('reply');
    $table->timestamps();
});
```

</p>
</details>

### Reply model relationships

#### Requirements

-   Create replies relationship on `Ticket` model
-   Create user relationship on `Reply` model

#### Hints

-   `hasMany(Model::class)`
-   `belongsTo(Model::class)`

<details><summary>Solution</summary>
<p>

**Ticket.php**

```php
class Ticket extends Model
{
    protected $fillable = ['title', 'content', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
```

**Reply.php**

```php
class Reply extends Model
{
    protected $fillable = ['user_id', 'ticket_id', 'reply'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
```

</p>
</details>

### Render replies

#### Requirements

-   Pass paginated (5 per page) replies on `show` view from `TicketsController`
-   Render replies
    -   Author name
    -   Reply (Content)
    -   Created_at formatted ('D m M Y')
    -   Pagination links

#### Hints

-   Get relationship data `Model::relationship()->paginated(10)`
-   `@foreach @endforeach`
-   `$model->links()` to render pagination links

<details><summary>Solution</summary>
<p>

**TicketsController.php**

```php
public function show(Ticket $ticket)
{
    $replies = $ticket->replies()->paginate(5);
    return view('tickets.show', compact('ticket', 'replies'));
}
```

**resources/tickets/show.blade.php**

```php
@extends('layouts.app')

@section('content')
<h3>{{$ticket->title}}</h3>
@can('update', $ticket)
<a href="{{action('TicketsController@edit', ['ticket' => $ticket->id])}}">Edit ticket</a>
@endcan
@can('delete', $ticket)
<form method="POST" action="{{action('TicketsController@destroy', ['ticket' => $ticket->id])}}">
  @csrf
  @method('DELETE')
  <input type="submit" value="Delete">
</form>
@endcan
<p>
  {{$ticket->content}}
</p>
<div>
  @foreach($replies as $reply)
  <div>
    <h5>Author: {{$reply->user->name}}</h5>
    <strong>{{$reply->created_at->format('D m M Y')}}</strong>
    <p>{{$reply->reply}}</p>
  </div>
  @endforeach
  {{$replies->links()}}
</div>
@endsection
```

**Reply.php**

```php
class Reply extends Model
{
    protected $fillable = ['user_id', 'ticket_id', 'reply'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
```

</p>
</details>

### Store reply

#### Requirements

-   Create replies resource controller
-   Remove all methods except store and destroy
-   Register a nested resource route only for store and destroy methods `tickets.replies`
-   Create new reply form on tickets.show view
    -   @csrf
    -   Reply text area
    -   Action to `RepliesController@store`
-   Validate reply
    -   Rules -> required, maximum characters 255
    -   Save reply
    -   Handle old values on error
-   Redirest `back` after save

#### Hints

-   `php artisan make:controller ControllerName --resource --model=ModelName`
-   `Route::resource('path.nested', 'ControllerName')`
-   `action('ControllerName@method')`
-   `$request->validate(['field_name' => 'rule1|rule2'])`
-   `old('field_name', $defaultValue)`
-   Redirect back using `back()` helper

<details><summary>Solution</summary>
<p>

**web.php**

```php
Route::middleware(['auth'])->group(function () {
    Route::resource('tickets', 'TicketsController');
    Route::resource('tickets.replies', 'RepliesController')->only(['store', 'destroy']);
});
```

**resources/views/tickets/show.blade.php**

```php
@extends('layouts.app')

@section('content')

<h3>{{$ticket->title}}</h3>
@can('update', $ticket)
<a href="{{action('TicketsController@edit', ['ticket' => $ticket->id])}}">Edit ticket</a>
@endcan
@can('delete', $ticket)
<form method="POST" action="{{action('TicketsController@destroy', ['ticket' => $ticket->id])}}">
  @csrf
  @method('DELETE')
  <input type="submit" value="Delete">
</form>
@endcan
<p>
  {{$ticket->content}}
</p>
// Create Reply Form
<form method="POST" action="{{action('RepliesController@store', ['ticket' => $ticket->id])}}">
  @csrf
  <textarea class="" name="reply" cols="30" rows="10">{{old('reply', '')}}</textarea>
  <input type="submit" value="Reply">
</form>
// End
<div>
  @foreach($replies as $reply)
  <div>
    <h5>Author: {{$reply->user->name}}</h5>
    <strong>{{$reply->created_at->format('D m M Y')}}</strong>
    <p>{{$reply->reply}}</p>
  </div>
  @endforeach
  {{$replies->links()}}
</div>
@endsection
```

**RepliesController**

```php
public function store(Request $request, Ticket $ticket)
{
    $validatedData = $request->validate([
        'reply' => 'required|max:255'
    ]);

    Reply::create([
        'reply' => $validatedData['reply'],
        'user_id' => Auth::user()->id,
        'ticket_id' => $ticket->id
    ]);

    return back();
}
```

</p>
</details>

### Deply reply

#### Requirements

-   Create delete form on each reply
    -   @csrf
    -   Delete method
    -   Action to RepliesController@destroy
-   Implement destroy method on `RepliesController@destroy`
-   Redirect back

#### Hints

-   `@method('DELETE')`
-   `action('ControllerName@method', ['reply' => $id])`
-   `$model->delete()`
-   `back()`

<details><summary>Solution</summary>
<p>

**resources/views/tickets/show.blade.php**

```php
@extends('layouts.app')

@section('content')
<h3>{{$ticket->title}}</h3>
@can('update', $ticket)
<a href="{{action('TicketsController@edit', ['ticket' => $ticket->id])}}">Edit ticket</a>
@endcan
@can('delete', $ticket)
<form method="POST" action="{{action('TicketsController@destroy', ['ticket' => $ticket->id])}}">
  @csrf
  @method('DELETE')
  <input type="submit" value="Delete">
</form>
@endcan
<p>
  {{$ticket->content}}
</p>
<form method="POST" action="{{action('RepliesController@store', ['ticket' => $ticket->id])}}">
  @csrf
  <textarea class="" name="reply" cols="30" rows="10">{{old('reply', '')}}</textarea>
  <input type="submit" value="Reply">
</form>
<div>
  @foreach($replies as $reply)
  <div>
    // DELETE FORM
    <form method="POST" action="{{action('RepliesController@destroy', ['ticket' => $ticket->id, 'reply' => $reply->id])}}">
      @csrf
      @method('DELETE')
      <input type="submit" value="Delete">
    </form>
    // END
    <h5>Author: {{$reply->user->name}}</h5>
    <strong>{{$reply->created_at->format('D m M Y')}}</strong>
    <p>{{$reply->reply}}</p>
  </div>
  @endforeach
  {{$replies->links()}}
</div>
@endsection
```

**RepliesController**

```php
public function destroy(Ticket $ticket, Reply $reply)
{
    $reply->delete();
    return back();
}
```

</p>
</details>

### Reply policy

#### Requirements

-   Create ReplyPolicy
-   Register ReplyPolicy on RepliesController
-   Implement ReplyPolicy methods
-   Show delete reply button if user is authorized to delete the reply

#### Hints

-   `php artisan make:policy ModelNamePolicy --model=ModelName`
-   `$this->authorizeResource(ModelName::class, 'model_name');`
-   `@can('model_name', $model) @endcan`

<details><summary>Solution</summary>
<p>

**RepliesController**

```php
public function __construct()
{
    $this->authorizeResource(Reply::class, 'reply');
}
```

**ReplyPolicy.php**

```php
class ReplyPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return false;
    }

    public function view(User $user, Reply $reply)
    {
        return false;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Reply $reply)
    {
        return false;
    }

    public function delete(User $user, Reply $reply)
    {
        return $user->id == $reply->user_id;
    }

    public function restore(User $user, Reply $reply)
    {
        return false;
    }

    public function forceDelete(User $user, Reply $reply)
    {
        return false;
    }
}
```

**resources/views/show.blade.php**

```php
@extends('layouts.app')

@section('content')
<h3>{{$ticket->title}}</h3>
@can('update', $ticket)
<a href="{{action('TicketsController@edit', ['ticket' => $ticket->id])}}">Edit ticket</a>
@endcan
@can('delete', $ticket)
<form method="POST" action="{{action('TicketsController@destroy', ['ticket' => $ticket->id])}}">
  @csrf
  @method('DELETE')
  <input type="submit" value="Delete">
</form>
@endcan
<p>
  {{$ticket->content}}
</p>
<form method="POST" action="{{action('RepliesController@store', ['ticket' => $ticket->id])}}">
  @csrf
  <textarea class="" name="reply" cols="30" rows="10">{{old('reply', '')}}</textarea>
  <input type="submit" value="Reply">
</form>
<div>
  @foreach($replies as $reply)
  <div>
    // REPLY POLICY
    @can('delete', $reply)
    <form method="POST" action="{{action('RepliesController@destroy', ['ticket' => $ticket->id, 'reply' => $reply->id])}}">
      @csrf
      @method('DELETE')
      <input type="submit" value="Delete">
    </form>
    @endcan
    // END
    <h5>Author: {{$reply->user->name}}</h5>
    <strong>{{$reply->created_at->format('D m M Y')}}</strong>
    <p>{{$reply->reply}}</p>
  </div>
  @endforeach
  {{$replies->links()}}
</div>
@endsection
```

</p>
</details>
