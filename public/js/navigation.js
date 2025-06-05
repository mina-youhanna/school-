document.addEventListener('DOMContentLoaded', function() {
    // Add hamburger menu button for mobile
    const nav = document.querySelector('nav');
    const menuToggle = document.createElement('div');
    menuToggle.className = 'menu-toggle';
    menuToggle.innerHTML = '&#9776;'; // Hamburger icon
    nav.prepend(menuToggle);

    // Target links container
    const linksContainer = document.querySelector('.links');
    
    // Toggle menu open/close
    menuToggle.addEventListener('click', function() {
        linksContainer.classList.toggle('active');
        
        // Change button appearance on toggle
        if (linksContainer.classList.contains('active')) {
            menuToggle.innerHTML = '&times;'; // Close icon
        } else {
            menuToggle.innerHTML = '&#9776;'; // Hamburger icon
        }
    });

    // Handle dropdown menus on mobile
    const dropdowns = document.querySelectorAll('.dropdown, .dropdown-left');
    
    dropdowns.forEach(dropdown => {
        const link = dropdown.querySelector('a');
        
        link.addEventListener('click', function(e) {
            // Only intercept clicks on mobile view
            if (window.innerWidth <= 992) {
                e.preventDefault();
                dropdown.classList.toggle('active');
                
                // Close other dropdowns
                dropdowns.forEach(other => {
                    if (other !== dropdown && !dropdown.contains(other)) {
                        other.classList.remove('active');
                    }
                });
            }
        });
    });

    // Close menu when clicking outside
    document.addEventListener('click', function(e) {
        if (!nav.contains(e.target)) {
            linksContainer.classList.remove('active');
            dropdowns.forEach(dropdown => {
                dropdown.classList.remove('active');
            });
            menuToggle.innerHTML = '&#9776;'; // Reset to hamburger icon
        }
    });

    // Close menu when navigating to other pages
    document.querySelectorAll('.links ul li a').forEach(link => {
        if (!link.parentElement.classList.contains('dropdown') && 
            !link.parentElement.classList.contains('dropdown-left')) {
            link.addEventListener('click', function() {
                linksContainer.classList.remove('active');
                menuToggle.innerHTML = '&#9776;';
            });
        }
    });

    // Reset menu state when resizing screen
    window.addEventListener('resize', function() {
        if (window.innerWidth > 992) {
            linksContainer.classList.remove('active');
            dropdowns.forEach(dropdown => {
                dropdown.classList.remove('active');
            });
            menuToggle.innerHTML = '&#9776;';
        }
    });

    // Notifications bell behavior
    const bellIcon = document.getElementById('bell-icon');
    const notificationsMenu = document.querySelector('.notifications-menu');
    
    if (bellIcon && notificationsMenu) {
        bellIcon.addEventListener('click', function(e) {
            e.stopPropagation();
            
            // Toggle notifications display
            if (notificationsMenu.style.display === 'block') {
                notificationsMenu.style.display = 'none';
                notificationsMenu.style.opacity = '0';
                notificationsMenu.style.visibility = 'hidden';
            } else {
                notificationsMenu.style.display = 'block';
                notificationsMenu.style.opacity = '1';
                notificationsMenu.style.visibility = 'visible';
            }
        });

        // Close notifications when clicking elsewhere
        document.addEventListener('click', function() {
            notificationsMenu.style.display = 'none';
            notificationsMenu.style.opacity = '0';
            notificationsMenu.style.visibility = 'hidden';
        });

        // Prevent closing when clicking inside the menu
        notificationsMenu.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    }
}); 