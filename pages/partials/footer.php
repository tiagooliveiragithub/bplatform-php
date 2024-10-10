<footer>

</footer>

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