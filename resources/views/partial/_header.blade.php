<header class="top-bar">
    <div class="header-title">
        <h2>School Facility Reservation System</h2>
        <p>Book rooms and facilities easily</p>
    </div>
    <div class="header-user">
        <div class="user-details">
            {{-- This pulls your real name and Student ID from the database --}}
            <span class="name">{{ Auth::user()->name }}</span>
            <span class="id">{{ Auth::user()->student_id }}</span>
        </div>
        {{-- This small snippet gets the first letter of your name for the avatar --}}
        <div class="avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
    </div>
</header>