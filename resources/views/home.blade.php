<x-my>
    <h1 class="text-2xl font-bold">Welcome to the tasks!</h1>
    @auth
        <p>See your tasks <a href="{{ url('/tasks') }}">here</a></p>
    @else
        <p>You need to <a href="{{ route('login') }}">log in </a> to see your tasks</p>
    @endauth
</x-my>
