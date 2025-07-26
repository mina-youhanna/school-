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
            menuToggle.innerHTML = '&#9776;';
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
            notificationsMenu.style.display = notificationsMenu.style.display === 'block' ? 'none' : 'block';
        });

        // Close notifications when clicking outside
        document.addEventListener('click', function(e) {
            if (!notificationsMenu.contains(e.target) && e.target !== bellIcon) {
                notificationsMenu.style.display = 'none';
            }
        });
    }

    // User profile dropdown behavior
    const userProfile = document.querySelector('.user-profile');
    const userDropdown = userProfile?.querySelector('.dropdown-menu');
    
    if (userProfile && userDropdown) {
        userProfile.addEventListener('click', function(e) {
            e.stopPropagation();
            userDropdown.style.display = userDropdown.style.display === 'block' ? 'none' : 'block';
        });

        // Close user dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!userDropdown.contains(e.target) && e.target !== userProfile) {
                userDropdown.style.display = 'none';
            }
        });
    }

    // Update user score periodically
    function updateUserScore() {
        const scoreElement = document.getElementById('user-score');
        if (scoreElement) {
            fetch('/api/user/score')
                .then(response => response.json())
                .then(data => {
                    if (data.score !== undefined) {
                        const oldScore = parseInt(scoreElement.textContent);
                        const newScore = data.score;
                        
                        if (oldScore !== newScore) {
                            // Animate score change
                            scoreElement.style.transform = 'scale(1.2)';
                            scoreElement.style.color = newScore > oldScore ? '#4CAF50' : '#FFD700';
                            
                            setTimeout(() => {
                                scoreElement.textContent = newScore;
                                scoreElement.style.transform = 'scale(1)';
                                scoreElement.style.color = '';
                            }, 300);
                        }
                    }
                })
                .catch(error => console.error('Error updating score:', error));
        }
    }

    // Update score every 30 seconds
    setInterval(updateUserScore, 30000);

    // Check for new notifications periodically
    function checkNotifications() {
        fetch('/api/notifications')
            .then(response => response.json())
            .then(data => {
                const notificationsList = document.querySelector('.notifications-menu ul');
                if (notificationsList && data.notifications) {
                    notificationsList.innerHTML = data.notifications.length > 0 
                        ? data.notifications.map(notification => `
                            <li>
                                <i class="fas ${notification.icon || 'fa-bell'}"></i>
                                ${notification.message}
                            </li>
                        `).join('')
                        : '<li>لا توجد إشعارات جديدة</li>';
                    
                    // Update bell icon if there are new notifications
                    if (bellIcon) {
                        bellIcon.style.color = data.notifications.length > 0 ? '#FFD700' : 'white';
                    }
                }
            })
            .catch(error => console.error('Error checking notifications:', error));
    }

    // Check notifications every minute
    setInterval(checkNotifications, 60000);
}); 