@extends('layouts.master')

@section('title', 'Privacy Policy | MoveSmooth')

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
                        <a href="#section-1" class="toc-link">1. Introduction & Scope</a>
                        <a href="#section-2" class="toc-link">2. Definitions & Interpretations</a>
                        <a href="#section-3" class="toc-link">3. Information We Collect</a>
                        <a href="#section-4" class="toc-link">4. Legal Bases for Processing</a>
                        <a href="#section-5" class="toc-link">5. How We Use Data</a>
                        <a href="#section-6" class="toc-link">6. Sharing & Disclosing Info</a>
                        <a href="#section-7" class="toc-link">7. Cookies & Analytics</a>
                        <a href="#section-8" class="toc-link">8. Cross-Border Transfers</a>
                        <a href="#section-9" class="toc-link">9. Data Security Measures</a>
                        <a href="#section-10" class="toc-link">10. Data Retention Policies</a>
                        <a href="#section-11" class="toc-link">11. Your Legal Privacy Rights</a>
                        <a href="#section-12" class="toc-link">12. Children's Privacy Rights</a>
                        <a href="#section-13" class="toc-link">13. Third-Party Websites</a>
                        <a href="#section-14" class="toc-link">14. Revisions & Amendments</a>
                        <a href="#section-15" class="toc-link">15. Contacting Our DPO</a>
                    </nav>
                </div>
            </div>

            <!-- Content Area -->
            <div class="col-lg-9">
                <div class="legal-card">
                    <h1 class="mb-2">Privacy Policy</h1>
                    <p class="text-muted mb-4">Effective Date: June 04, 2026 | Last Updated: June 04, 2026</p>
                    <hr class="mb-5">

                    <p class="lead text-dark">Welcome to MoveSmooth. We respect your personal privacy and are fully committed to protecting the integrity, confidentiality, and security of all personal data that you share with us. This Privacy Policy is designed to provide you with a clear, comprehensive, and legally robust explanation of how we collect, process, maintain, protect, and share your personal information when you use our website, digital platform, moving cost calculators, comparison grids, and related customer support systems.</p>

                    <p>By accessing or interacting with the MoveSmooth website, completing dynamic moving estimate requests, comparing listing credentials of registered moving companies, writing reviews, or contacting us through any online interface, you acknowledge that you have read and understood the terms of this Privacy Policy. If you do not agree with the terms and practices outlined below, you must immediately discontinue your use of our platforms and services.</p>

                    <!-- Section 1 -->
                    <h2 id="section-1">1. Introduction and Scope of Policy</h2>
                    <p>MoveSmooth (referred to herein as "MoveSmooth," "we," "our," or "us") operates a comprehensive consumer relocation logistics directory, rating database, and moving quote coordination system. Our platform serves as an information conduit, connecting individual consumers (referred to as "users," "you," or "your") with registered, licensed, and independent professional moving service providers (referred to as "Movers," "Moving Companies," or "Service Providers").</p>
                    <p>This Privacy Policy applies strictly to data collected directly via the MoveSmooth website (movesmooth.com), its subdomains, customer inquiry web forms, database services, API endpoints, email correspondence, and telephone communications conducted under the authorization of MoveSmooth. This Policy does not apply to the operations, personnel, websites, or data management policies of any independent Moving Company. Once your information is transferred to a Mover for the purpose of compiling a quote, that Mover becomes an independent data controller, and their own privacy terms govern the handling of your data. We highly encourage you to review the privacy documentation of any selected Mover before signing a contract.</p>

                    <!-- Section 2 -->
                    <h2 id="section-2">2. Definitions and Key Interpretations</h2>
                    <p>To ensure total transparency throughout this document, the following definitions are established in compliance with prevailing data privacy regulations, including the European Union's General Data Protection Regulation (GDPR) and the California Consumer Privacy Act (CCPA/CPRA):</p>
                    <ul>
                        <li><strong>Personal Data / Personal Information:</strong> Any information relating to an identified or identifiable natural person. This includes names, email addresses, phone numbers, dynamic IP addresses, coordinates, postal addresses, USDOT licensing associations, and moving inventory specifications.</li>
                        <li><strong>Processing:</strong> Any operation performed on Personal Data, such as collection, recording, classification, structuring, storage, adaptation, retrieval, consultation, dissemination, sharing, or erasure.</li>
                        <li><strong>Data Controller:</strong> The natural or legal person who determines the purposes and means of processing Personal Data. MoveSmooth acts as a Data Controller for the database and platform inputs you submit.</li>
                        <li><strong>Data Processor:</strong> Any third-party service provider processing Personal Data on behalf of the Data Controller. This includes cloud server hostings, email dispatch relays, and telemetry platforms.</li>
                        <li><strong>Mover Leads / Direct Requests:</strong> The relocation details (such as route zip codes, volume size, target date, and contact credentials) submitted by a user to secure moving quotes from verified providers.</li>
                    </ul>

                    <!-- Section 3 -->
                    <h2 id="section-3">3. Detailed Breakdown of Information We Collect</h2>
                    <p>Depending on how you interact with our platform, we collect several categories of information to help optimize your planning and coordinate verified logistics. This collection is divided into three primary categories:</p>
                    
                    <h3>3.1 Information You Provide to Us Voluntarily</h3>
                    <p>When you utilize our interactive cost calculators, register a company listing, write consumer reviews, or submit support tickets, you manually input data. This contains:</p>
                    <ul>
                        <li><strong>Contact Details:</strong> Your full name, telephone number, and email address. This is required so that we can communicate transaction summaries and share quote responses.</li>
                        <li><strong>Relocation Coordinates:</strong> Your current location origin (specifically ZIP code, city, and state) and your destination target (ZIP code, city, state, or country).</li>
                        <li><strong>Move Parameters:</strong> The size of your home (e.g., 1-bedroom apartment, 3-bedroom house), number of rooms, total volume or weight estimates, desired moving date, packing service choices (full-service, labor-only), and storage unit preferences.</li>
                        <li><strong>Custom Messages:</strong> Special instructions, fragile items descriptions, and delivery specifications written into text fields.</li>
                        <li><strong>User Reviews:</strong> Ratings, textual feedback, and documentation detailing your experience with specific Movers.</li>
                    </ul>

                    <h3>3.2 Information Collected Automatically Through Technology</h3>
                    <p>As you navigate our pages, our servers automatically collect telemetry data using tracking mechanisms. This includes:</p>
                    <ul>
                        <li><strong>Device and Connection Metrics:</strong> Your IP address, browser type and version, browser language settings, operating system, and hardware configuration.</li>
                        <li><strong>Usage Telemetry:</strong> Referral sources, page view histories, time spent on individual comparison grids, click counts, navigation patterns, search query history, and date/time stamps.</li>
                        <li><strong>Geolocation Data:</strong> Broad location parameters derived from IP addresses to pre-populate closest regional cities.</li>
                    </ul>

                    <h3>3.3 Information Acquired from External Third Parties</h3>
                    <p>We routinely verify the operational standards of registered movers. This involves acquiring database details from:
                        Federal Motor Carrier Safety Administration (FMCSA) registration systems, USDOT certification archives, business registration registries, and public review aggregators.
                    </p>

                    <!-- Section 4 -->
                    <h2 id="section-4">4. Legitimate Legal Bases for Processing Data</h2>
                    <p>If you reside within the European Economic Area (EEA), United Kingdom (UK), or jurisdictions with similar legal protections, we only collect and process your Personal Data where we have valid legal bases to do so. Under Article 6 of the GDPR, these bases include:</p>
                    <ol>
                        <li><strong>Performance of a Contract:</strong> Processing is necessary to deliver the services you request. When you request a quote, we process and share your move parameters to establish pre-contractual price estimates with Movers.</li>
                        <li><strong>Consent:</strong> You have given clear, explicit consent for us to process your data for specific actions, such as sending marketing newsletters or utilizing non-essential tracking cookies. You have the right to withdraw consent at any time.</li>
                        <li><strong>Legitimate Interests:</strong> Processing is required for our legitimate business operations, provided these interests do not override your fundamental rights. This includes analyzing site usage to improve the comparison interface, debugging server errors, preventing fraudulent quote submissions, and ensuring platform security.</li>
                        <li><strong>Legal Obligations:</strong> Processing is required to comply with statutory mandates, such as tax regulations, corporate auditing, or responding to court orders.</li>
                    </ol>

                    <!-- Section 5 -->
                    <h2 id="section-5">5. Detailed Explanation of How We Use Your Data</h2>
                    <p>We use the data we collect for various business and commercial purposes. These applications are designed to save you time and maximize transparency. Specific uses include:</p>
                    <ul>
                        <li><strong>Quote Facilitation & Connection:</strong> Transmitting your moving parameters and contact coordinates directly to the verified Movers you select or match with in order to compile and deliver binding or non-binding moving estimates.</li>
                        <li><strong>Platform Maintenance & Enhancement:</strong> Operating our web systems, rendering the comparison tool, improving the search database, and developing new features like automated volume estimators.</li>
                        <li><strong>Customer Support:</strong> Answering inquiries, resolving issues with forms, verifying reviews, and troubleshooting account login issues.</li>
                        <li><strong>User Communications:</strong> Sending automated email confirmations for lead submissions, system notifications, sitemap updates, and promotional deals matching your relocation path (where permitted).</li>
                        <li><strong>Fraud Mitigation & Compliance:</strong> Monitoring for bot activity, detecting duplicate reviews, verifying USDOT database registrations, and protecting the security of our infrastructure.</li>
                    </ul>

                    <!-- Section 6 -->
                    <h2 id="section-6">6. Sharing and Disclosure of Information</h2>
                    <p>We do not sell, rent, or lease your personal contact information to third-party marketing companies. We share your information only under the following limited, secure conditions:</p>

                    <h3>6.1 Authorized Moving Service Providers</h3>
                    <p>When you select moving companies on our Comparison Page or search directory and click "Get Quote," you authorize us to transmit your name, phone number, email address, route coordinates, and move size to those specific Movers. This allows them to contact you directly with accurate cost summaries. These Movers are strictly prohibited from using your contact details for any purpose other than providing quote estimates and scheduling services.</p>

                    <h3>6.2 External Third-Party Vendors and Subcontractors</h3>
                    <p>We utilize trusted Data Processors to support our operations. These vendors operate under strict data protection agreements and cannot use your data for independent purposes. They include cloud hosting platforms, database managers, SMTP email servers, mapping and ZIP code autocomplete APIs, and website telemetry tools.</p>

                    <h3>6.3 Legal Compliance, Enforcement, and Emergency Scenarios</h3>
                    <p>We may disclose your Personal Data if required by federal or local law, subpoena, or regulatory inquiry, or if we believe in good faith that disclosure is necessary to comply with legal actions, protect the safety of our users, prevent fraud, or defend MoveSmooth's intellectual property rights.</p>

                    <h3>6.4 Corporate Reorganization and Business Transitions</h3>
                    <p>In the event of a merger, acquisition, corporate restructuring, asset sale, or bankruptcy, your personal information may be transferred as part of the business assets to the acquiring entity. You will be notified via email or a prominent notice on our website of any change in ownership or usage rights.</p>

                    <!-- Section 7 -->
                    <h2 id="section-7">7. Comprehensive Cookie and Tracking Technologies</h2>
                    <p>MoveSmooth utilizes cookies, tracking pixels, local storage, and similar technologies to enhance page navigation, keep comparison slots populated during your session, remember search histories, and gather usage metrics. We compile aggregate data to understand which articles, calculator tools, and moving directories are most popular.</p>
                    <p>For a detailed breakdown of the cookies we use, their retention duration, and instructions on how you can manage or opt-out of tracking, please consult our full, dedicated <a href="{{ route('front.cookies') }}">Cookie Policy</a>.</p>

                    <!-- Section 8 -->
                    <h2 id="section-8">8. International Cross-Border Data Transfers</h2>
                    <p>MoveSmooth is operated and hosted in the United States. If you access our platform from Canada, Europe, or other international regions, please be aware that the information we collect will be transferred to and processed in the United States, where data protection standards may differ from your home country. By utilizing our services, you consent to this transfer, storage, and processing. We implement Standard Contractual Clauses (SCCs) approved by the European Commission where applicable to ensure data remains protected.</p>

                    <!-- Section 9 -->
                    <h2 id="section-9">9. Strategic Data Security Safeguards</h2>
                    <p>The security of your personal data is a top priority for MoveSmooth. We implement and maintain appropriate technical, organizational, and administrative safeguards to protect your personal data from unauthorized access, accidental loss, alteration, destruction, or disclosure. These measures include:</p>
                    <ul>
                        <li>Using Transport Layer Security (TLS/SSL) encryption for all web pages and data collection forms.</li>
                        <li>Storing database records on secure cloud environments protected by advanced firewalls.</li>
                        <li>Restricting access to customer details to authorized MoveSmooth personnel who require that data to support platform operations.</li>
                        <li>Conducting regular audits of our code, database access control layers, and hosting protocols to patch potential vulnerabilities.</li>
                    </ul>
                    <p>Please note, however, that no method of transmission over the internet or method of electronic storage is 100% secure. While we strive to use industry-standard means to protect your information, we cannot guarantee absolute security.</p>

                    <!-- Section 10 -->
                    <h2 id="section-10">10. Data Retention Policies and Archiving</h2>
                    <p>We retain your Personal Data only for as long as is necessary to fulfill the specific purposes for which it was collected, as detailed in this policy, or to comply with legal, accounting, tax, or regulatory requirements. Specifically:</p>
                    <ul>
                        <li><strong>Mover Leads / Quote Details:</strong> Retained for a standard period of 24 months to support dispute resolutions, verify quote transactions, and compile long-term regional moving cost trends. After 24 months, contact credentials are anonymized.</li>
                        <li><strong>Platform Analytics:</strong> Kept in aggregate form indefinitely, but individual session IP records are deleted or anonymized within 90 days.</li>
                        <li><strong>User Reviews:</strong> Retained as long as the MoveSmooth directory is active, unless the user requests deletion.</li>
                    </ul>

                    <!-- Section 11 -->
                    <h2 id="section-11">11. Your Comprehensive Legal Privacy Rights</h2>
                    <p>Depending on your geographic location and local jurisdiction, you possess specific statutory rights regarding your Personal Data. We are committed to honoring these rights for all users:</p>

                    <h3>11.1 Rights Under the General Data Protection Regulation (GDPR)</h3>
                    <p>If you reside within the European Union or United Kingdom, you have the following rights under the GDPR:</p>
                    <ul>
                        <li><strong>Right of Access:</strong> You can request a copy of the personal data we hold about you.</li>
                        <li><strong>Right to Rectification:</strong> You can request that we correct inaccurate or incomplete details.</li>
                        <li><strong>Right to Erasure ("Right to be Forgotten"):</strong> You can request the permanent deletion of your data under specific conditions.</li>
                        <li><strong>Right to Restriction:</strong> You can request that we suspend processing your data while we investigate disputes.</li>
                        <li><strong>Right to Data Portability:</strong> You can request that we export your data in a structured, machine-readable format.</li>
                        <li><strong>Right to Object:</strong> You can object to processing based on legitimate interests or direct marketing.</li>
                    </ul>

                    <h3>11.2 Rights Under the California Consumer Privacy Act (CCPA/CPRA)</h3>
                    <p>If you are a California resident, you possess the following rights:</p>
                    <ul>
                        <li><strong>Right to Know:</strong> You can request details about the categories of personal data collected, shared, or disclosed over the past 12 months.</li>
                        <li><strong>Right to Delete:</strong> You can request deletion of personal information collected from you.</li>
                        <li><strong>Right to Correct:</strong> You can request correction of inaccurate personal data.</li>
                        <li><strong>Right to Opt-Out of Sale or Sharing:</strong> MoveSmooth does not sell your personal data for money. However, sharing data for targeted ads can be opted out of by contacting us.</li>
                        <li><strong>Right to Non-Discrimination:</strong> We will not deny services or charge different rates if you exercise your privacy rights.</li>
                    </ul>

                    <h3>11.3 Rights for Residents of Other US States</h3>
                    <p>Residents of Virginia (VCDPA), Colorado (CPA), Connecticut (CTDPA), Utah (UCPA), and Texas (TDPSA) possess comparable consumer data protection rights, including the right to access, correct, delete, export, and opt-out of targeted advertising. To exercise any of these rights, please follow the steps outlined in the contact section below.</p>

                    <!-- Section 12 -->
                    <h2 id="section-12">12. Children's Privacy Rights and Age Restrictions</h2>
                    <p>MoveSmooth is designed exclusively for adults planning household relocations. We do not knowingly solicit, collect, or process information from children under the age of 16. If we discover that we have accidentally collected personal data from a child under 16 without verified parental consent, we will delete that data from our active systems immediately. If you believe a child has provided us with personal information, please contact our support team.</p>

                    <!-- Section 13 -->
                    <h2 id="section-13">13. Hyperlinks to External Third-Party Web Portals</h2>
                    <p>Our comparison tools, mover profile grids, and blog articles contain links to external websites, including the direct websites of registered Movers. MoveSmooth does not monitor, control, or take responsibility for the content, security, or data handling practices of these external sites. Clicking an external link is done at your own risk, and we recommend reviewing their respective privacy policies.</p>

                    <!-- Section 14 -->
                    <h2 id="section-14">14. Amendments and Revisions to This Policy</h2>
                    <p>We reserve the right to amend, update, or revise this Privacy Policy at any time to reflect changes in our database tools, service offerings, business operations, or statutory requirements. When updates are published, we will revise the "Last Updated" date at the top of this page. If the changes are material, we will post a prominent notice on our homepage or send an email notification to registered users. We recommend checking this page periodically to stay informed.</p>

                    <!-- Section 15 -->
                    <h2 id="section-15">15. Contacting Our Data Protection Officer</h2>
                    <p>If you have any questions, concerns, comments, or complaints regarding this Privacy Policy, or if you wish to exercise your legal privacy rights (such as submitting an access or deletion request), please contact our Data Protection Officer (DPO) using the details below:</p>
                    
                    <div class="card p-4 bg-light border-0 mt-4" style="border-radius: 12px;">
                        <h6 class="fw-bold text-dark mb-2">MoveSmooth Privacy Operations</h6>
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
