<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Department Expenses Monitoring App</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Custom Tailwind Config -->
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#2563eb',
            secondary: '#10b981',
          },
        },
      },
    };
  </script>

  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #1e3a8a, #10b981);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(12px);
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
      border-radius: 1rem;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
      transform: translateY(-6px);
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.25);
    }

    .btn-primary {
      background-color: #2563eb;
      color: white;
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #1e40af;
      transform: scale(1.05);
    }

    .btn-outline {
      border: 2px solid #2563eb;
      color: #2563eb;
      transition: all 0.3s ease;
    }

    .btn-outline:hover {
      background-color: #2563eb;
      color: white;
      transform: scale(1.05);
    }

    .logo {
      width: 120px;
      height: auto;
      margin: 0 auto 1rem;
    }
  </style>
</head>

<body>
  <div class="px-6 sm:px-8 w-full max-w-lg">
    <div class="card p-10 text-center">

      <!-- Logo -->
      <img src="images/DEMA-logo.png" alt="Logo" class="logo">

      <!-- Heading -->
      <h1 class="text-3xl sm:text-4xl font-bold text-gray-800 mb-4">
        Welcome to the Department Expenses Monitoring App
      </h1>

      <!-- Subheading -->
      <p class="text-lg text-gray-600 mb-6">
        Track, analyze, and manage your department’s spending efficiently.
      </p>

      <!-- CTA Buttons -->
      <div class="flex justify-center space-x-4">
        <a href="login.html" class="btn-primary px-6 py-3 rounded-lg font-semibold text-lg shadow-md">Login</a>
        <a href="register.html" class="btn-outline px-6 py-3 rounded-lg font-semibold text-lg">Register</a>
      </div>

      <!-- Footer -->
      <p class="text-sm text-gray-500 mt-8">
        © 2025 Department Expenses Monitoring App. All rights reserved.
      </p>
    </div>
  </div>
</body>

</html>
