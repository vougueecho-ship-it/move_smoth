@extends('layouts.master')

@section('title', 'Cookie Policy | MoveSmooth')

@section('custom_styles')
<style>
    html {
        scroll-behavior: smooth;
    }
    .legal-page {
        padding: 80px 0;
        background: #f8fafc;
    }
    .legal-card {
        background: white;
        border-radius: 24px;
        padding: 50px;
        box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
        line-height: 1.8;
    }
    .legal-card h1 {
        font-size: 2.5rem;
        font-weight: 800;
        color: #0f172a;
    }
    .legal-card h2 {
        font-size: 1.5rem;
        margin-top: 40px;
        margin-bottom: 20px;
        color: #0f172a;
        font-weight: 700;
        border-bottom: 1px solid #f1f5f9;
        padding-bottom: 10px;
    }
    .legal-card h3 {
        font-size: 1.2rem;
        margin-top: 30px;
        margin-bottom: 15px;
        color: #1e293b;
        font-weight: 700;
    }
    .legal-card p, .legal-card li {
        color: #475569;
        font-size: 1rem;
    }
    .legal-card ul, .legal-card ol {
        margin-bottom: 20px;
        padding-left: 20px;
    }
    .legal-card li {
        margin-bottom: 8px;
    }
    .legal-sidebar {
        position: -webkit-sticky;
        position: sticky;
        top: 100px;
        align-self: start;
        z-index: 10;
    }
    .toc-card {
        background: white;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        padding: 24px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
    }
    .toc-link {
        display: block;
        padding: 8px 12px;
        color: #64748b;
        text-decoration: none;
        border-left: 2px solid transparent;
        font-size: 0.9rem;
        transition: all 0.2s ease;
        font-weight: 500;
    }
    .toc-link:hover, .toc-link.active {
        color: #2563eb;
        border-left-color: #2563eb;
        background: #f8fafc;
        border-radius: 0 8px 8px 0;
    }
    .cookie-table th {
        background: #0f172a;
        color: white !important;
        font-size: 0.9rem;
        font-weight: 700;
    }
    .cookie-table td {
        font-size: 0.85rem;
        color: #475569;
    }
</style>
@endsection

@section('content')
<div class="legal-page">
    <div class="container">
        <div class="row g-5">
            <!-- Sidebar TOC -->
            <div class="col-lg-3 d-none d-lg-block legal-sidebar">
                <div class="toc-card">
                    <h5 class="fw-bold text-dark mb-3">Table of Contents</h5>
                    <nav class="d-flex flex-column gap-1">
                        <a href="#section-1" class="toc-link">1. Intro & Cookie Scope</a>
                        <a href="#section-2" class="toc-link">2. What Are Cookies?</a>
                        <a href="#section-3" class="toc-link">3. Why We Use Cookies</a>
                        <a href="#section-4" class="toc-link">4. Cookie Classifications</a>
                        <a href="#section-5" class="toc-link">5. Mover Platform Registry</a>
                        <a href="#section-6" class="toc-link">6. Third-Party Trackers</a>
                        <a href="#section-7" class="toc-link">7. Managing Browser Choices</a>
                        <a href="#section-8" class="toc-link">8. Consent Settings Banner</a>
                        <a href="#section-9" class="toc-link">9. Data Security Concerns</a>
                        <a href="#section-10" class="toc-link">10. Regulatory Compliance</a>
                        <a href="#section-11" class="toc-link">11. Policy Modifications</a>
                        <a href="#section-12" class="toc-link">12. Reaching Support DPO</a>
                    </nav>
                </div>
            </div>

            <!-- Content Area -->
            <div class="col-lg-9">
                <div class="legal-card">
                    <h1 class="mb-2">Cookie Policy</h1>
                    <p class="text-muted mb-4">Effective Date: June 04, 2026 | Last Updated: June 04, 2026</p>
                    <hr class="mb-5">

                    <p class="lead text-dark">This Cookie Policy (referred to herein as the "Cookie Policy" or "Policy") explains in detail how MoveSmooth (referred to as "MoveSmooth," "we," "our," or "us") utilizes cookies, web beacons, tracking pixels, clear GIFs, local storage, and similar technologies (collectively, "Tracking Technologies") on our website, movesmooth.com, and all associated digital subdomains, forms, tools, and calculators.</p>

                    <p>By entering, browsing, or utilizing the MoveSmooth digital platform, you acknowledge and agree that we may collect and store telemetry, preferences, and activity records using these tracking tools. We are committed to transparency in all of our data handling practices, and this document serves to outline what these files do, how they benefit your user experience, and the precise tools you can use to limit or refuse their deployment.</p>

                    <!-- Section 1 -->
                    <h2 id="section-1">1. Introduction & Cookie Scope</h2>
                    <p>When you prepare for a move, coordinating timelines and sorting inventories requires a highly interactive user experience. To facilitate comparison tools, retain selected moving companies in comparison slots, and generate cost estimates, MoveSmooth relies on temporary and persistent data storage configurations. This Cookie Policy applies to any digital interface where MoveSmooth tools are deployed.</p>
                    <p>Please note that this Policy does not govern the cookie operations of independent moving companies listed on our directory. Once you navigate to a third-party Mover's external web portal via our "Visit Site" link, their respective cookie controls apply. We strongly recommend reading the cookie terms of any external website you visit.</p>

                    <!-- Section 2 -->
                    <h2 id="section-2">2. What Exactly Are Cookies?</h2>
                    <p>A cookie is a small text file containing a string of alphanumeric characters that is transferred to your computer, tablet, or smartphone hard drive by a web page server when you visit a website. The cookie allows the website to recognize your unique browser, device profile, and session parameters when you navigate between pages or return to the site in the future.</p>
                    <p>Cookies can be classified by their source, function, and lifecycle:</p>
                    <ul>
                        <li><strong>Session Cookies:</strong> Temporary files that exist only for the duration of your browser session. They are automatically deleted from your device when you close your web browser. They are used to facilitate page navigation and forms.</li>
                        <li><strong>Persistent Cookies:</strong> Longer-term files that remain on your hard drive after you close your browser. They expire on a set date or after a specific period (ranging from days to years) and are used to remember your search preferences, locations, or account logins on future visits.</li>
                        <li><strong>First-Party Cookies:</strong> Set directly by MoveSmooth (the domain owner). These are crucial for the basic operation of the Platform.</li>
                        <li><strong>Third-Party Cookies:</strong> Placed by partner organizations, such as telemetry services (Google Analytics), security systems (Google reCAPTCHA), or map APIs. They track browsing habits across multiple platforms to optimize marketing or analytics.</li>
                    </ul>

                    <!-- Section 3 -->
                    <h2 id="section-3">3. Why We Use Cookies on Our Platform</h2>
                    <p>MoveSmooth utilizes Tracking Technologies to achieve specific technical goals. Without these files, many features (such as comparing moving companies side-by-side) would not function correctly. The core reasons we deploy cookies are:</p>
                    <ol>
                        <li><strong>Session Maintenance:</strong> Keeping your selected Movers saved in the Comparison slots (Slot 1, Slot 2, Slot 3, Slot 4) as you navigate between pages or read guides.</li>
                        <li><strong>Autocomplete Memory:</strong> Remembering the ZIP codes or cities you input in the calculator forms so you do not have to type them repeatedly.</li>
                        <li><strong>Telemetry and Site Health:</strong> Tracking loading speeds, database response rates, and broken link notifications to ensure the platform operates efficiently.</li>
                        <li><strong>Authentication and Security:</strong> Verifying user profiles, preventing spam submissions on quote forms, and securing review submissions.</li>
                        <li><strong>Partnerships and Analytics:</strong> Compiling statistical datasets to determine which moving companies and relocation guides receive the most traffic.</li>
                    </ol>

                    <!-- Section 4 -->
                    <h2 id="section-4">4. Comprehensive Cookie Classifications</h2>
                    <p>To give you granular control, we categorize the cookies deployed on MoveSmooth into four functional groups:</p>

                    <h3>4.1 Essential / Strictly Necessary Cookies</h3>
                    <p>These cookies are required for the website to function and cannot be switched off in our systems. They are usually set in response to actions made by you, such as setting your privacy preferences, logging in, or filling in moving quote request forms. They include security cookies that prevent Cross-Site Request Forgery (CSRF) attacks. You can set your browser to block or alert you about these cookies, but some parts of the site will not work.</p>

                    <h3>4.2 Performance & Analytics Cookies</h3>
                    <p>These cookies collect information about how visitors interact with our Platform. They count page views, monitor referral sources, detect slow loading speeds, and measure user interaction times. All information collected by these cookies is aggregated and therefore anonymized. We use this data solely to improve our website's structure, search queries, and load speeds.</p>

                    <h3>4.3 Functional & Preference Cookies</h3>
                    <p>These cookies enable the Platform to provide enhanced personalization and custom features. They remember choices you make, such as your preferred language, nearest metro area, or moving cost search query filters. They may be set by us or by third-party providers whose services we have added to our pages. If you do not allow these cookies, some personalized settings may not function correctly.</p>

                    <h3>4.4 Targeting & Advertising Cookies</h3>
                    <p>These cookies may be set through our site by advertising partners. They may be used by those companies to build a profile of your interests and show you relevant adverts on other sites, such as partner discounts on packing materials or vehicle transport services matching your route. They do not store directly personal information, but are based on uniquely identifying your browser and internet device.</p>

                    <!-- Section 5 -->
                    <h2 id="section-5">5. MoveSmooth Platform Cookie Registry</h2>
                    <p>The table below provides a detailed registry of the specific cookies used on the MoveSmooth Platform, including their category, provider, purpose, and retention duration:</p>

                    <div class="table-responsive my-4">
                        <table class="table table-bordered bg-white cookie-table">
                            <thead>
                                <tr>
                                    <th>Cookie Name</th>
                                    <th>Category</th>
                                    <th>Provider</th>
                                    <th>Specific Purpose</th>
                                    <th>Duration</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>XSRF-TOKEN</strong></td>
                                    <td>Strictly Necessary</td>
                                    <td>MoveSmooth</td>
                                    <td>Prevents Cross-Site Request Forgery security attacks.</td>
                                    <td>Session</td>
                                </tr>
                                <tr>
                                    <td><strong>movesmooth_session</strong></td>
                                    <td>Strictly Necessary</td>
                                    <td>MoveSmooth</td>
                                    <td>Maintains user state, calculator progression, and comparison slot selections.</td>
                                    <td>2 Hours</td>
                                </tr>
                                <tr>
                                    <td><strong>_ga</strong></td>
                                    <td>Performance / Analytics</td>
                                    <td>Google Analytics</td>
                                    <td>Registers a unique ID used to generate statistical data on site usage.</td>
                                    <td>2 Years</td>
                                </tr>
                                <tr>
                                    <td><strong>_gid</strong></td>
                                    <td>Performance / Analytics</td>
                                    <td>Google Analytics</td>
                                    <td>Registers a unique ID used to track visitor behavior patterns within 24 hours.</td>
                                    <td>24 Hours</td>
                                </tr>
                                <tr>
                                    <td><strong>_gat</strong></td>
                                    <td>Performance / Analytics</td>
                                    <td>Google Analytics</td>
                                    <td>Used to throttle request rate, limiting data collection on high-traffic pages.</td>
                                    <td>1 Minute</td>
                                </tr>
                                <tr>
                                    <td><strong>zip_history</strong></td>
                                    <td>Functional</td>
                                    <td>MoveSmooth</td>
                                    <td>Remembers recently entered ZIP codes to speed up quote form calculations.</td>
                                    <td>30 Days</td>
                                </tr>
                                <tr>
                                    <td><strong>dnt_preference</strong></td>
                                    <td>Strictly Necessary</td>
                                    <td>MoveSmooth</td>
                                    <td>Saves user choice regarding tracking opt-outs (Do Not Track).</td>
                                    <td>1 Year</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Section 6 -->
                    <h2 id="section-6">6. Third-Party Tracking Technologies</h2>
                    <p>In addition to our first-party cookies, we integrate tools from external partners to enhance security, mapping, and analytics. These third parties use their own tracking technologies, which are governed by their respective privacy terms:</p>
                    <ul>
                        <li><strong>Google Analytics:</strong> We use Google Analytics to compile aggregated visitor statistics. You can opt out of Google Analytics tracking across all websites by installing the Google Analytics Opt-out Browser Add-on.</li>
                        <li><strong>Google Maps API:</strong> We integrate mapping tools to help autocomplete ZIP codes and calculate precise routes between your moving origin and destination. Google Maps may track your general request location to render maps.</li>
                        <li><strong>Google reCAPTCHA:</strong> Deployed on our lead submission and review forms to detect and block automated bot entries. It analyzes hardware, software, and behavior patterns to verify human presence.</li>
                    </ul>

                    <!-- Section 7 -->
                    <h2 id="section-7">7. Managing Browser Choices</h2>
                    <p>You have the absolute right to accept, reject, customize, or delete cookies. Most web browsers are configured to accept cookies automatically by default, but they provide tools to let you control these settings:</p>
                    <p>To adjust cookie settings in your browser, consult the help menu of your browser. Below are direct navigation tips for popular systems:</p>
                    <ul>
                        <li><strong>Google Chrome:</strong> Navigate to Settings > Privacy and Security > Cookies and other site data.</li>
                        <li><strong>Apple Safari:</strong> Navigate to Preferences > Privacy > Block all cookies, or manage local storage.</li>
                        <li><strong>Mozilla Firefox:</strong> Navigate to Options > Privacy & Security > Enhanced Tracking Protection.</li>
                        <li><strong>Microsoft Edge:</strong> Navigate to Settings > Cookies and site permissions > Manage and delete cookies and site data.</li>
                    </ul>
                    <p>Please note that if you disable or clear cookies entirely, some premium features of MoveSmooth (such as the interactive comparison grids or form autocomplete) may not load correctly.</p>

                    <!-- Section 8 -->
                    <h2 id="section-8">8. Consent Settings Banner</h2>
                    <p>When you visit MoveSmooth for the first time, a prominent cookie consent banner is displayed at the bottom of the screen. This banner alerts you to our use of Tracking Technologies and allows you to customize your preferences. You can choose to accept all cookies, decline non-essential (analytics, marketing, functional) cookies, or read our policies. Your choices are saved in a strictly necessary preference cookie for 12 months, after which we will prompt you again.</p>

                    <!-- Section 9 -->
                    <h2 id="section-9">9. Data Security and Cookie Integrity</h2>
                    <p>To prevent malicious tracking or data interception, MoveSmooth implements secure flags on all first-party cookies. This includes:</p>
                    <ul>
                        <li><strong>HttpOnly Flag:</strong> Restricts access to cookie values via client-side JavaScript, protecting session tokens from Cross-Site Scripting (XSS) hijacking.</li>
                        <li><strong>Secure Flag:</strong> Mandates that cookies are transmitted exclusively over encrypted HTTPS connections, preventing packet sniffing.</li>
                        <li><strong>SameSite Attribute:</strong> Set to `Strict` or `Lax` to prevent session cookies from being transmitted during cross-site requests, mitigating CSRF risk.</li>
                    </ul>

                    <!-- Section 10 -->
                    <h2 id="section-10">10. Regulatory Compliance and Legal Protections</h2>
                    <p>Our cookie practices are designed to comply with major international and local consumer privacy frameworks:</p>
                    <ul>
                        <li><strong>GDPR & ePrivacy Directive (Europe/UK):</strong> We require explicit, opt-in consent before setting any non-essential cookies on devices of users accessing our platform from the EEA or UK. We provide a granular panel to customize these consents.</li>
                        <li><strong>CCPA/CPRA (California):</strong> We do not sell or share cookie data for monetary gains. However, users can click our "Do Not Sell or Share My Info" link to opt-out of third-party advertising tracking.</li>
                    </ul>

                    <!-- Section 11 -->
                    <h2 id="section-11">11. Policy Modifications and Revisions</h2>
                    <p>MoveSmooth reserves the right to amend, update, or revise this Cookie Policy at any time to reflect updates in our technology stack, hosting integrations, or legal compliance standards. When updates are published, we will revise the "Last Updated" date at the top of this page. We encourage you to check this page periodically to stay informed about how we use Tracking Technologies.</p>

                    <!-- Section 12 -->
                    <h2 id="section-12">12. Reaching Support DPO</h2>
                    <p>If you have any questions, comments, or concerns regarding our Cookie Policy, or if you need assistance configuring your privacy preferences on our site, please contact our Data Protection Officer:</p>

                    <div class="card p-4 bg-light border-0 mt-4" style="border-radius: 12px;">
                        <h6 class="fw-bold text-dark mb-2">MoveSmooth Cookie & Privacy Inquiry</h6>
                        <ul class="list-unstyled mb-0 small">
                            <li><i class="fas fa-envelope text-primary me-2"></i> Email: <strong>contact@movesmooth.com</strong></li>
                            <li><i class="fas fa-map-marker-alt text-primary me-2"></i> Address: <strong>5900 Balcones Drive STE 100, Austin, TX 78731</strong></li>
                            <li><i class="fas fa-phone-alt text-primary me-2"></i> Phone: <strong>+1 (406) 505-9198</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sections = document.querySelectorAll('.legal-card h2');
        const tocLinks = document.querySelectorAll('.toc-link');

        function changeActiveTocLink() {
            let index = sections.length;

            while(--index && window.scrollY + 150 < sections[index].offsetTop) {}
            
            tocLinks.forEach((link) => link.classList.remove('active'));
            if (index >= 0 && index < tocLinks.length) {
                tocLinks[index].classList.add('active');
            }
        }

        changeActiveTocLink();
        window.addEventListener('scroll', changeActiveTocLink);
    });
</script>
@endsection
