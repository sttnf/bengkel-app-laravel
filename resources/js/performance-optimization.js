// Advanced Performance Optimization for Workshop Pro Landing Page

document.addEventListener('DOMContentLoaded', function() {
    // 1. Image Lazy Loading with Intersection Observer
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove('lazy');
                img.classList.add('loaded');
                observer.unobserve(img);
            }
        });
    });

    document.querySelectorAll('img[data-src]').forEach(img => {
        imageObserver.observe(img);
    });

    // 2. Smooth Scrolling Enhancement
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                const headerOffset = 80;
                const elementPosition = target.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });

    // 3. Performance Monitoring
    if ('performance' in window) {
        window.addEventListener('load', function() {
            setTimeout(function() {
                const perfData = performance.getEntriesByType('navigation')[0];
                console.log('Page Load Performance:', {
                    domContentLoaded: Math.round(perfData.domContentLoadedEventEnd - perfData.navigationStart),
                    fullLoad: Math.round(perfData.loadEventEnd - perfData.navigationStart),
                    firstPaint: Math.round(performance.getEntriesByType('paint')[0]?.startTime || 0),
                    largestContentfulPaint: Math.round(performance.getEntriesByType('largest-contentful-paint')[0]?.startTime || 0)
                });
            }, 0);
        });
    }

    // 4. Critical CSS Loading
    const loadCSS = function(href) {
        const link = document.createElement('link');
        link.rel = 'stylesheet';
        link.href = href;
        link.media = 'print';
        link.onload = function() {
            this.media = 'all';
        };
        document.head.appendChild(link);
    };

    // 5. Preconnect to External Domains
    const preconnect = function(href) {
        const link = document.createElement('link');
        link.rel = 'preconnect';
        link.href = href;
        document.head.appendChild(link);
    };

    // Preconnect to critical external resources
    preconnect('https://fonts.googleapis.com');
    preconnect('https://images.unsplash.com');
    preconnect('https://randomuser.me');

    // 6. Service Worker Registration for Caching
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function() {
            navigator.serviceWorker.register('/sw.js')
                .then(function(registration) {
                    console.log('SW registered: ', registration);
                })
                .catch(function(registrationError) {
                    console.log('SW registration failed: ', registrationError);
                });
        });
    }

    // 7. Intersection Observer for Animations
    const animationObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
                animationObserver.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    // Observe elements for animation
    document.querySelectorAll('[data-animate]').forEach(el => {
        animationObserver.observe(el);
    });

    // 8. Debounced Scroll Handler
    let scrollTimer = null;
    const handleScroll = function() {
        if (scrollTimer !== null) {
            clearTimeout(scrollTimer);
        }
        scrollTimer = setTimeout(function() {
            // Custom scroll handling here
            const scrollY = window.pageYOffset;
            
            // Parallax effect for hero section
            const hero = document.querySelector('.hero-parallax');
            if (hero) {
                hero.style.transform = `translateY(${scrollY * 0.5}px)`;
            }
            
            // Update progress indicator
            const progressBar = document.querySelector('.scroll-progress');
            if (progressBar) {
                const docHeight = document.documentElement.scrollHeight - window.innerHeight;
                const progress = (scrollY / docHeight) * 100;
                progressBar.style.width = `${progress}%`;
            }
        }, 10);
    };

    window.addEventListener('scroll', handleScroll, { passive: true });

    // 9. Resource Hints for Better Performance
    const addResourceHints = function() {
        const hints = [
            { rel: 'dns-prefetch', href: '//fonts.googleapis.com' },
            { rel: 'dns-prefetch', href: '//images.unsplash.com' },
            { rel: 'preload', href: '/fonts/inter.woff2', as: 'font', type: 'font/woff2', crossorigin: '' }
        ];

        hints.forEach(hint => {
            const link = document.createElement('link');
            Object.keys(hint).forEach(key => {
                link.setAttribute(key, hint[key]);
            });
            document.head.appendChild(link);
        });
    };

    addResourceHints();

    // 10. Memory Management for Large Lists
    const virtualizeList = function(container, items, renderItem) {
        const itemHeight = 100; // Adjust based on your item height
        const containerHeight = container.clientHeight;
        const visibleItems = Math.ceil(containerHeight / itemHeight) + 2;
        
        let scrollTop = 0;
        
        const updateList = function() {
            const startIndex = Math.floor(scrollTop / itemHeight);
            const endIndex = Math.min(startIndex + visibleItems, items.length);
            
            container.innerHTML = '';
            
            for (let i = startIndex; i < endIndex; i++) {
                const item = renderItem(items[i], i);
                item.style.position = 'absolute';
                item.style.top = `${i * itemHeight}px`;
                container.appendChild(item);
            }
            
            container.style.height = `${items.length * itemHeight}px`;
        };
        
        container.addEventListener('scroll', function() {
            scrollTop = container.scrollTop;
            requestAnimationFrame(updateList);
        });
        
        updateList();
    };

    // 11. Error Boundary for JavaScript Errors
    window.addEventListener('error', function(e) {
        console.error('JavaScript Error:', {
            message: e.message,
            source: e.filename,
            line: e.lineno,
            column: e.colno,
            error: e.error
        });
        
        // Optionally send to analytics or error tracking service
        // sendErrorToService(e);
    });

    // 12. Battery and Network Aware Features
    if ('getBattery' in navigator) {
        navigator.getBattery().then(function(battery) {
            if (battery.level < 0.2) {
                // Reduce animations and effects when battery is low
                document.documentElement.classList.add('battery-save');
            }
        });
    }

    if ('connection' in navigator) {
        const connection = navigator.connection;
        if (connection.effectiveType === 'slow-2g' || connection.effectiveType === '2g') {
            // Reduce features for slow connections
            document.documentElement.classList.add('slow-connection');
        }
    }
});

// Export for potential use in other modules
export {
    // Add any functions you want to expose
};
