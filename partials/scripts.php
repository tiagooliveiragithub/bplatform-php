<script>
  const themeToggleButton = document.getElementById('theme-toggle');
  const themeIcon = document.getElementById('theme-icon');
  const currentTheme = localStorage.getItem('theme') || 'light';

  // Set the theme on page load
  if (currentTheme === 'dark') {
    document.body.classList.add('dark');
    themeIcon.classList.remove('fa-moon');
    themeIcon.classList.add('fa-sun'); // Switch to sun icon for dark theme
  }

  // Toggle theme on button click
  themeToggleButton.addEventListener('click', () => {
    document.body.classList.toggle('dark');

    // Update the icon based on the theme
    if (document.body.classList.contains('dark')) {
      themeIcon.classList.remove('fa-moon');
      themeIcon.classList.add('fa-sun'); // Sun icon for dark mode
    } else {
      themeIcon.classList.remove('fa-sun');
      themeIcon.classList.add('fa-moon'); // Moon icon for light mode
    }

    // Store the theme in localStorage
    const theme = document.body.classList.contains('dark') ? 'dark' : 'light';
    localStorage.setItem('theme', theme);
  });
</script>

<script>
  document.getElementById('toggleCreatePassword').addEventListener('click', function () {
    const passwordField = document.getElementById('createpassword');
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);

    // Toggle icon between open and closed eye
    if (type === 'text') {
      this.classList.remove('fa-eye');
      this.classList.add('fa-eye-slash');
    } else {
      this.classList.remove('fa-eye-slash');
      this.classList.add('fa-eye');
    }
  });

  document.getElementById('toggleConfirmPassword').addEventListener('click', function () {
    const passwordField = document.getElementById('confirmpassword');
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);

    // Toggle icon between open and closed eye
    if (type === 'text') {
      this.classList.remove('fa-eye');
      this.classList.add('fa-eye-slash');
    } else {
      this.classList.remove('fa-eye-slash');
      this.classList.add('fa-eye');
    }
  });

</script>