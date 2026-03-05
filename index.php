<?php require_once 'includes/header.php'; ?>

<main>
    <section class="hero">
        <div class="container">
            <h1>It all starts with a domain.</h1>
            <p>Make your idea real. specialized marketing tools included.</p>
            
            <div class="domain-search-container">
                <input type="text" id="domainSearchInput" placeholder="Find your perfect domain + website" autocomplete="off">
                <button id="domainSearchBtn" class="btn btn-primary" style="padding: 0 40px; font-size: 1.1rem;">Search</button>
            </div>
            
            <div id="searchResults" style="max-width: 800px; margin: 20px auto; text-align: left;">
                <!-- Results will appear here -->
            </div>
        </div>
    </section>
    
    <section class="container features">
        <div class="feature-card">
            <h3>.com</h3>
            <p style="color: #666; margin: 10px 0;">The world's most popular domain.</p>
            <h2 style="color: var(--primary-color);">$11.99*</h2>
            <p style="font-size: 0.8rem; color: #999;">1st year only</p>
        </div>
        <div class="feature-card">
            <h3>.net</h3>
            <p style="color: #666; margin: 10px 0;">Build your network.</p>
            <h2 style="color: var(--primary-color);">$14.99*</h2>
            <p style="font-size: 0.8rem; color: #999;">1st year only</p>
        </div>
        <div class="feature-card">
            <h3>.io</h3>
            <p style="color: #666; margin: 10px 0;">The choice for tech.</p>
            <h2 style="color: var(--primary-color);">$39.99*</h2>
            <p style="font-size: 0.8rem; color: #999;">1st year only</p>
        </div>
    </section>
    
    <section style="background-color: var(--light-bg); padding: 60px 0;">
        <div class="container" style="display: flex; gap: 40px; align-items: center; flex-wrap: wrap;">
            <div style="flex: 1; min-width: 300px;">
                <img src="https://img1.wsimg.com/isteam/stock/106362/:/cr=t:0%25,l:0%25,w:100%25,h:100%25/rs=w:600,h:300,cg:true" alt="Promo" style="width: 100%; border-radius: 8px;">
            </div>
            <div style="flex: 1; min-width: 300px;">
                <h2 style="font-size: 2.5rem; margin-bottom: 20px; font-family: 'Times New Roman', serif;">Why go with Goddady?</h2>
                <ul style="font-size: 1.1rem; line-height: 2;">
                    <li><i class="fas fa-check" style="color: green; margin-right: 10px;"></i> 24/7/365 Support</li>
                    <li><i class="fas fa-check" style="color: green; margin-right: 10px;"></i> Trusted by 20+ million customers</li>
                    <li><i class="fas fa-check" style="color: green; margin-right: 10px;"></i> The world's largest registrar</li>
                </ul>
            </div>
        </div>
    </section>
</main>

<?php require_once 'includes/footer.php'; ?>
