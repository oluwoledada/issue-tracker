# TALL Stack Overview and Walkthrough

## Installation

```bash
composer install
```

```bash
npm install
```

```bash
cp .env.example .env
```

```bash
php artisan key:generate
```

## Development

```bash
php artisan serve
```

```bash
npm run dev
```

## Blog post

### Table of Contents

-   [Introduction](#introduction)
-   [Section 1](#section-1)
-   [Section 2](#section-2)
-   [Conclusion](#conclusion)

### Introduction

The TALL Stack simplifies full-stack development, seamlessly combining front-end and back-end capabilities to build modern and interactive Laravel applications. It consists of four key technologies, each represented by a letter in the acronym:

1. Tailwind: A CSS utility framework that streamlines styling by providing an extensive set of utility classes for direct application to HTML elements.
2. Alpine: A lightweight declarative JavaScript framework designed for building interactive user interfaces, offering simplicity and ease of use.
3. Laravel: A PHP-based web application framework known for its elegant syntax and comprehensive feature set, serving as the backbone for the TALL stack.
4. Livewire: Front-end components that seamlessly synchronize with the back-end state, eliminating the need for manual API development and enhancing the efficiency of dynamic web applications.

In this blog post, we’ll use the TALL stack to build an easy-to-use issue tracker application.

### Section 1

Before diving into the TALL stack, it’s good to have some prior knowledge. If you’re new to PHP or Laravel, it’s recommended to familiarize yourself with them first.

### Setup and Installation

#### Step 1: Laravel Installation

Create a new Laravel project using Composer:

```bash
composer create-project --prefer-dist laravel/laravel issue-tracker
```

```bash
cd issue-tracker
```

#### Step 2: Install Livewire

```bash
composer require livewire/livewire
```

#### Step 3: Install Tailwind CSS

```bash
npm install -D tailwindcss postcss autoprefixer
```

Next, we need to generate our Tailwind CSS and PostCSS config file using `npx`.

```bash
npx tailwindcss init -p
```

#### Step 4: Configure Tailwind CSS

Open your tailwind.config.js file and customize it according to your preferences. Update the `content` array with the following:

```bash
content: [
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
],
```

Now we can add the Tailwind directives to our `app.css` file, located in `./resources/css/app.css`

```bash
@tailwind base;
@tailwind components;
@tailwind utilities;
```

Add this line of code to the `welcome.blade.php` file to load Load CSS and JS using Vite:

```bash
@vite(['resources/css/app.css', 'resources/js/app.js'])
```

#### Step 5: Create Livewire Component

```bash
php artisan make:livewire IssueTracker
```

Add this line to the `body` of the `welcome.blade.php` file:

```bash
@livewire('issue-tracker')
```

#### Step 6: Install dependencies and run the app

```bash
npm install
```

```bash
npm run dev
```

```bash
php artisan serve
```

### Section 2

Navigate to the `app/Livewire/IssueTracker.php` directory and insert the following code snippet into the `IssueTracker.php` file.

```bash
<?php

namespace App\Livewire;

use Livewire\Component;

class IssueTracker extends Component
{
    public $issues = [];

    public $newIssue;

    public function addIssue()
    {
        if ($this->newIssue) {
            $this->issues[] = ['name' => $this->newIssue, 'status' => 'backlog', 'completed' => false];
            $this->newIssue = '';
        }
    }

    public function updateStatus($index, $status)
    {
        $this->issues[$index]['status'] = $status;
    }

    public function deleteIssue($index)
    {
        unset($this->issues[$index]);
    }

    public function render()
    {
        return view('livewire.issue-tracker');
    }
}
```

Next, go to the `issue-tracker.blade.php` file in the `resources/views/livewire/issue-tracker.blade.php` directory and add the following code.

```bash
<div class="px-8 my-8">
    <h1 class="flex justify-center text-4xl font-bold">Issue Tracker</h1>

    <div class="flex justify-center gap-2 my-6">
        <input wire:model="newIssue" type="text" placeholder="Add a new issue" class="border rounded p-2">
        <button wire:click="addIssue" class="bg-blue-500 text-white px-4 py-2 rounded">New issue</button>
    </div>

    <div class="grid grid-cols-1 items-start gap-4 lg:grid-cols-4">
        @foreach(['backlog', 'todo', 'ongoing', 'completed'] as $status)
            <div class="flex flex-col overflow-hidden rounded-lg bg-white shadow-lg">
                <!-- Category header with background color -->
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
```

### Conclusion

To sum it up, the TALL stack is a great tool for making modern websites with Laravel. It’s simple, efficient, and loved by many developers. By combining Tailwind CSS, Alpine.js, Laravel, and Livewire, you can easily create websites that react and interact the way you want them to. It’s a fantastic choice for developers looking to build powerful, modern, and reactive web applications.
