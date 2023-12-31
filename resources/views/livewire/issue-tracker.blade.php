<div class="px-8 my-8">
    <h1 class="flex justify-center text-4xl font-bold">Issue Tracker</h1>

    <div class="flex justify-center gap-2 my-6">
        <input wire:model="newIssue" type="text" placeholder="Add a new issue" class="border rounded p-2">
        <button wire:click="addIssue" class="bg-blue-500 text-white px-4 py-2 rounded">New issue</button>
    </div>

    <div class="grid grid-cols-1 items-start gap-4 lg:grid-cols-4">
        @foreach(['backlog', 'todo', 'ongoing', 'completed'] as $status)
            <div class="flex flex-col overflow-hidden rounded-lg bg-white shadow-lg">
                <div class="bg-gray-200 p-1">
                    <h3 class="text-lg font-semibold px-2">{{ ucfirst($status) }}</h3>
                </div>

                <ul class="grow p-3">
                    @foreach($issues as $index => $issue)
                        @if($issue['status'] === $status)
                            <h6 class="mb-2 border-b-2 border-gray-200 py-1 text-2xl font-medium">
                                {{ $issue['name'] }}
                            </h6>
                            <li>
                                <div class="text-xs space-y-3">
                                    <button wire:click="updateStatus({{ $index }}, 'backlog')" class="inline-flex items-center justify-center space-x-2 rounded-lg border bg-gray-300 px-2 py-1">
                                        Backlog
                                    </button>
                                    <button wire:click="updateStatus({{ $index }}, 'todo')" class="bg-yellow-300 px-2 py-1 rounded">
                                        Todo
                                    </button>
                                    <button wire:click="updateStatus({{ $index }}, 'ongoing')" class="bg-blue-300 px-3 py-1 rounded">
                                        Ongoing
                                    </button>
                                    <button wire:click="updateStatus({{ $index }}, 'completed')" class="bg-green-300 px-2 py-1 rounded">
                                        Completed
                                    </button>
                                    <button wire:click="deleteIssue({{ $index }})" class="bg-red-500 text-white px-2 py-1 rounded">
                                        Delete
                                    </button>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</div>
