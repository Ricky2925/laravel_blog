<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container" style="max-width: 500px; margin-top: 50px;">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-center">Login</h2>

                <!-- 登录表单 -->
                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>

                <!-- 注册链接 -->
                <div class="text-center mt-3">
                    <p>Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
                    <p>Go Home<a href="/">Home here</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
