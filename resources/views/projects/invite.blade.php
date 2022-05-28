<div class="card flex flex-col mt-3">

    <h3 class="font-normal text-xl py-4 -ml-5 border-l-4 border-blue-900 pl-4 mb-3">
        Invite a user
    </h3>

        <form action="{{ $project->path(). '/invitations' }}" method="post">
            @csrf

            <div class="mb-3">
                <input type="email" name="email" class="border border-gray-300 rounded py-1 px-2 w-full" placeholder="Enter email">
            </div>

            <button type="submit" class="button">Invite</button>

        </form>

        @include('error', ['bag' => 'invitations'])
</div>
