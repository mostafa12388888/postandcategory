@extends('layouts.frontend.app')
@section('title')
    {{ config('app.name') }} | seating
@endsection
@section('body')
@php
            $user=auth()->user();
@endphp
    <!-- Dashboard Start-->
    <br />
    <br />
    <br />
    <br />
    <div class="dashboard container">
        <!-- Sidebar -->
        <aside class="col-md-3 nav-sticky dashboard-sidebar">
            <!-- User Info Section -->
            <div class="user-info text-center p-3">
                <img src="{{ '/storage' . auth()->user()?->image }}" alt="User Image" class="rounded-circle mb-2"
                    style="width: 80px; height: 80px;">
                <!-- style="width: 80px; height: 80px; object-fit: cover" /> -->
                <h5 class="mb-0" style="color: #ff6f61">{{ auth()->user()?->name }}</h5>
            </div>

            <!-- Sidebar Menu -->
            <div class="list-group profile-sidebar-menu">
                <a href="{{ route('frontend.dashboard.profile') }}" class="list-group-item list-group-item-action menu-item"
                    data-section="profile">
                    <i class="fas fa-user"></i> Profile
                </a>
                <a href="./notifications.html" class="list-group-item list-group-item-action menu-item"
                    data-section="notifications">
                    <i class="fas fa-bell"></i> Notifications
                </a>
                <a href="{{ route('frontend.dashboard.setting') }}"
                    class="list-group-item list-group-item-action active menu-item" data-section="settings">
                    <i class="fas fa-cog"></i> Settings
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Settings Section -->
            <section id="settings" class="content-section active">
                <h2>Settings</h2>
                <form action="{{ route('frontend.dashboard.setting.update') }}" method="post" class="settings-form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" value="{{ $user->user_name }}" />
                        @error('username')
                            <small>
                            {{$message}}
                            </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="username">name:</label>
                        <input type="text" id="name" name="name" value="{{ $user->name }}" />
                        @error('name')
                        <small>
                        {{$message}}
                        </small>
                    @enderror

                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" value="{{ $user->email }}" />
                        @error('email')
                        <small>
                        {{$message}}
                        </small>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label for="profile-image">Profile Image:</label>
                        <input type="file" name="image" id="profile-image" accept="image/*" />
                        @error('image')
                        <small>
                        {{$message}}
                        </small>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label for="country">Country:</label>
                        <input type="text" id="country" name="country" placeholder="Enter your country"
                            value="{{ $user->country }}" />
                            @error('country')
                            <small>
                            {{$message}}
                            </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="city">City:</label>
                        <input type="text" id="city"name="city" placeholder="Enter your city"
                            value="{{ $user->city }}" />
                            @error('city')
                            <small>
                            {{$message}}
                            </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="street">Street:</label>
                        <input type="text" id="street" name="street" placeholder="Enter your street"
                            value="{{ $user->street }}" />
                            @error('street')
                            <small>
                            {{$message}}
                            </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="text" id="phone" name="phone" placeholder="Enter your phone"
                            value="{{ $user->phone }}" />
                            @error('phone')
                            <small>
                            {{$message}}
                            </small>
                        @enderror
                    </div>

                    <button type="submit" class="save-settings-btn">
                        Save Changes
                    </button>
                </form>

                <!-- Form to change the password -->
                <form class="change-password-form">
                    <h2>Change Password</h2>
                    <div class="form-group">
                        <label for="current-password">Current Password:</label>
                        <input type="password" id="current-password" placeholder="Enter Current Password" />
                    </div>
                    <div class="form-group">
                        <label for="new-password">New Password:</label>
                        <input type="password" id="new-password" placeholder="Enter New Password" />
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirm New Password:</label>
                        <input type="password" id="confirm-password" placeholder="Enter Confirm New " />
                    </div>
                    <button type="submit" class="change-password-btn">
                        Change Password
                    </button>
                </form>
            </section>
        </div>
    </div>
    <br />
    <br />
    <br />
    <br />

    <!-- Dashboard End-->
@endsection
