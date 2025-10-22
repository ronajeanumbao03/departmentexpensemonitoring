<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Department Expenses Monitoring App</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600;700&display=swap" rel="stylesheet">

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Custom Tailwind Config -->
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            govBlue: '#1a4480',
            govGold: '#ffcc00',
            govGray: '#f0f0f0',
          },
          fontFamily: {
            sans: ['"Source Sans Pro"', 'sans-serif']
          }
        },
      },
    };
  </script>

  <style>
    body {
      background-color: #ffffff;
      color: #1a1a1a;
      font-family: "Source Sans Pro", sans-serif;
    }

    header {
      background-color: #1a4480;
      color: white;
      padding: 1rem 0;
    }

    header img {
      height: 50px;
    }

    .cta-button {
      display: inline-block;
      background-color: #1a4480;
      color: white;
      padding: 0.75rem 1.5rem;
      font-weight: 600;
      border-radius: 0.25rem;
      transition: all 0.2s ease-in-out;
    }

    .cta-button:hover {
      background-color: #163b6d;
    }

    .secondary-button {
      display: inline-block;
      background-color: white;
      color: #1a4480;
      border: 2px solid #1a4480;
      padding: 0.75rem 1.5rem;
      font-weight: 600;
      border-radius: 0.25rem;
      transition: all 0.2s ease-in-out;
    }

    .secondary-button:hover {
      background-color: #1a4480;
      color: white;
    }

    footer {
      background-color: #f0f0f0;
      text-align: center;
      padding: 1.5rem 0;
      color: #333;
      font-size: 0.9rem;
      border-top: 4px solid #ffcc00;
    }
  </style>
</head>

<body>
  <!-- Header -->
  <header class="shadow-md">
    <div class="container mx-auto flex items-center justify-between px-6">
      <div class="flex items-center space-x-3">
        <img src="images/DEMA-logo.png" alt="Logo">
        <h1 class="text-2xl font-semibold">Department Expenses Monitoring App</h1>
      </div>
    </div>
  </header>

  <!-- Main content -->
  <main class="container mx-auto py-16 px-6 text-center max-w-3xl">
    <h2 class="text-4xl font-bold text-govBlue mb-4">
      Manage Your Department’s Expenses Responsibly
    </h2>
    <p class="text-lg text-gray-700 mb-8">
      Stay on top of departmental spending, budgeting, and financial reporting.
      Track every expense with transparency and accountability — just like how preparedness starts with awareness.
    </p>

    <div class="space-x-4">
      <a href="login.html" class="cta-button">Login</a>
      <a href="register.html" class="secondary-button">Register</a>
    </div>

    <div class="mt-12 border-t border-gray-200 pt-6 text-left text-gray-600">
      <h3 class="text-2xl font-semibold text-govBlue mb-2">Why Use This App?</h3>
      <ul class="list-disc list-inside space-y-2">
        <li>Ensure transparency in departmental budgeting</li>
        <li>Monitor spending trends and reports</li>
        <li>Promote accountability and data-driven decisions</li>
      </ul>
    </div>
  </main>

  <!-- Footer -->
  <footer>
    <p>© 2025 Department Expenses Monitoring App — A transparency initiative for better governance.</p>
  </footer>
</body>

</html>
