<x-guest-layout>
  <form method="POST" action="{{ route('login') }}">
      @csrf

      <!-- Email Address -->
      <div class="mb-3">
          <label for="email" class="form-label">{{ __('Email Address') }}</label>
          <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
          @error('email')
              <div class="text-danger small">{{ $message }}</div>
          @enderror
      </div>

      <!-- Password -->
      <div class="mb-3">
          <label for="password" class="form-label">{{ __('Password') }}</label>
          <input id="password" type="password" name="password" class="form-control" required>
          @error('password')
              <div class="text-danger small">{{ $message }}</div>
          @enderror
      </div>

      <!-- Submit Button -->
      <div class="d-grid">
          <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
      </div>
  </form>
</x-guest-layout>
