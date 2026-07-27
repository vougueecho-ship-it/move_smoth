@extends('layouts.master')

@section('title', 'Terms of Service | MoveSmooth')

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
                        <a href="#section-1" class="toc-link">1. Acceptance of Terms</a>
                        <a href="#section-2" class="toc-link">2. Definitions of Key Terms</a>
                        <a href="#section-3" class="toc-link">3. Eligibility & Registrations</a>
                        <a href="#section-4" class="toc-link">4. Platform Rules & Use</a>
                        <a href="#section-5" class="toc-link">5. Quote Request Process</a>
                        <a href="#section-6" class="toc-link">6. Independent Mover Status</a>
                        <a href="#section-7" class="toc-link">7. User Content & Reviews</a>
                        <a href="#section-8" class="toc-link">8. Intellectual Property</a>
                        <a href="#section-9" class="toc-link">9. Disclaimer of Warranties</a>
                        <a href="#section-10" class="toc-link">10. Limitation of Liability</a>
                        <a href="#section-11" class="toc-link">11. Indemnification</a>
                        <a href="#section-12" class="toc-link">12. Dispute Resolution</a>
                        <a href="#section-13" class="toc-link">13. Severability & Waiver</a>
                        <a href="#section-14" class="toc-link">14. Service Termination</a>
                        <a href="#section-15" class="toc-link">15. Terms Modifications</a>
                    </nav>
                </div>
            </div>

            <!-- Content Area -->
            <div class="col-lg-9">
                <div class="legal-card">
                    <h1 class="mb-2">Terms of Service</h1>
                    <p class="text-muted mb-4">Effective Date: June 04, 2026 | Last Updated: June 04, 2026</p>
                    <hr class="mb-5">

                    <p class="lead text-dark">Welcome to MoveSmooth. Please read these Terms of Service (referred to herein as the "Terms," "Agreement," or "Terms of Service") carefully before accessing, browsing, or using our website, moving cost calculators, quote forms, directories, comparison grids, reviews system, or support channels. These Terms establish a legally binding agreement between you and MoveSmooth governing your access to and use of our platform.</p>

                    <p>By entering, browsing, or utilizing the MoveSmooth website (movesmooth.com) or submitting any moving lead form, you agree to be bound by these Terms, as well as our Privacy Policy and Cookie Policy. If you do not agree to all of the terms, covenants, and restrictions contained in this Agreement, you are not authorized to use the platform, and you must exit the website immediately.</p>

                    <!-- Section 1 -->
                    <h2 id="section-1">1. Acceptance of Terms and Scope of Agreement</h2>
                    <p>MoveSmooth (referred to as "MoveSmooth," "we," "our," or "us") provides an online platform designed to connect consumers planning a relocation with independent, licensed, and registered professional moving companies (referred to as "Movers," "Moving Companies," or "Service Providers"). This Agreement applies to all visitors, registered users, commercial listing owners, and anyone who interacts with the MoveSmooth digital infrastructure.</p>
                    <p>Please note that MoveSmooth is not a licensed household goods motor carrier, broker, or freight forwarder. We do not transport cargo, hire drivers, operate trucks, pack boxes, or broker moving contracts. We operate strictly as an informational directory and matchmaking platform. Any agreement, scheduling, pricing, or contract you enter into with a Moving Company is strictly between you and that Mover. MoveSmooth is not a party to, and bears absolutely no legal or financial responsibility under, any agreement you establish with a third-party Mover.</p>

                    <!-- Section 2 -->
                    <h2 id="section-2">2. Definitions of Key Terms</h2>
                    <p>To ensure clarity, the following terms when capitalized in this Agreement shall have the meanings defined below:</p>
                    <ul>
                        <li><strong>Platform:</strong> The MoveSmooth website (movesmooth.com), its subdomains, databases, proprietary APIs, software scripts, and dynamic quote forms.</li>
                        <li><strong>User:</strong> Any individual consumer who visits the Platform, utilizes the cost calculators, compares Mover profiles, or submits a quote request.</li>
                        <li><strong>Mover Profile:</strong> The listing page dedicated to a specific moving company, displaying their ratings, user reviews, base location, services, and USDOT numbers.</li>
                        <li><strong>Lead Submission:</strong> The package of relocation coordinates, inventory parameters, dates, and contact credentials submitted by a User via the Platform to obtain pricing estimates.</li>
                        <li><strong>Content:</strong> All text, ratings, reviews, code, layout designs, sitemaps, graphics, images, and tools displayed on the Platform.</li>
                    </ul>

                    <!-- Section 3 -->
                    <h2 id="section-3">3. Eligibility and User Account Registrations</h2>
                    <p>By accessing or registering an account on our Platform, you warrant and represent that you are at least 18 years of age and possess the legal capacity to enter into binding contracts. If you are accessing this Platform on behalf of a corporate entity or commercial enterprise, you warrant that you hold the legal authority to bind that entity to these Terms.</p>
                    <p>While you do not need to register a user account to search directory listings or run the cost calculator, certain features (such as writing reviews, listing a Mover business, or viewing historical quote submissions) may require creating a profile. You agree to provide accurate, current, and complete details during registration and to update these details immediately if they change. You are solely responsible for maintaining the confidentiality of your account credentials and for all activities that occur under your username. You agree to notify us immediately of any unauthorized use or breach of security.</p>

                    <!-- Section 4 -->
                    <h2 id="section-4">4. Platform Rules and Permitted Use</h2>
                    <p>MoveSmooth grants you a limited, non-exclusive, non-transferable, and revocable license to access and use the Platform strictly for personal, non-commercial purposes (unless you are a registered Mover using a commercial profile). You agree to use the Platform in compliance with all local, state, federal, and international laws.</p>
                    <p>You strictly agree that you will NOT engage in any of the following prohibited behaviors:</p>
                    <ul>
                        <li>Using the Platform for any fraudulent or malicious purpose, including submitting fake moving quote requests with false contact information or fake inventories.</li>
                        <li>Utilizing automated scraper bots, spiders, web crawlers, indexers, or data mining software to harvest mover contact details, review lists, or database structures without our explicit written permission.</li>
                        <li>Posting artificial, defamatory, malicious, or duplicate consumer reviews. All reviews must represent genuine, first-hand experiences with a Mover.</li>
                        <li>Attempting to bypass, disable, or breach the security features, database access controls, or firewall layers of our servers.</li>
                        <li>Using the Platform to distribute viruses, malware, trojan horses, spam, or unsolicited marketing emails to registered Movers or platform users.</li>
                    </ul>

                    <!-- Section 5 -->
                    <h2 id="section-5">5. The Quote Request and Matchmaking Process</h2>
                    <p>When you complete a dynamic form on our Platform (such as the 4-step cost estimator or a direct contact Mover form), you request MoveSmooth to transmit your details to selected Movers. By clicking "Get Quote" or "Submit Request," you explicitly authorize MoveSmooth to transmit your name, phone number, email address, route coordinates, and inventory details to those specific Movers so they can contact you directly to compile pricing estimates.</p>
                    <p>You acknowledge that any cost estimates generated directly by the Platform's calculators are broad projections designed for baseline comparison and budgeting purposes. They do not constitute binding contracts. The final binding or non-binding estimate can only be issued by the Mover after they perform a virtual or physical inventory survey. MoveSmooth does not guarantee the accuracy of any automated price projections, nor do we guarantee that any Mover will respond to your request.</p>

                    <!-- Section 6 -->
                    <h2 id="section-6">6. Independent Mover Status and Licensing Disclaimers</h2>
                    <p>MoveSmooth displays licensing details (such as USDOT and MC numbers) and ratings for independent moving companies. While we perform periodic database synchronizations with the Federal Motor Carrier Safety Administration (FMCSA) records, we do not warrant or guarantee that the information is completely up-to-date, error-free, or comprehensive. It remains your absolute responsibility to independently verify the active licensing status, insurance certificates, and safety records of any Mover you choose to hire.</p>
                    <p>We do not endorse, recommend, warrant, or guarantee the service quality, safety, dependability, or competence of any Mover listed on our Platform. Movers are entirely independent third-party contractors. We do not inspect their trucks, verify their employees' background checks, check their driving records, or supervise their operations. Your decision to hire any Mover is made entirely at your own risk.</p>

                    <!-- Section 7 -->
                    <h2 id="section-7">7. User Generated Content and Review Guidelines</h2>
                    <p>Users may post reviews, ratings, comments, and other feedback regarding Movers (collectively, "User Generated Content"). By posting User Generated Content on MoveSmooth, you warrant that:</p>
                    <ul>
                        <li>You are the sole author and owner of the intellectual property rights to that content.</li>
                        <li>The content is accurate, honest, and represents a real transaction you had with the Mover.</li>
                        <li>The content is not defamatory, libelous, harassing, offensive, or racially biased.</li>
                        <li>You did not receive any financial compensation, discount, or incentive from the Mover to write a positive review, nor are you an employee or direct competitor of the Mover.</li>
                    </ul>
                    <p>By posting content, you grant MoveSmooth an irrevocable, perpetual, worldwide, royalty-free, and fully sub-licensable license to host, display, reproduce, modify, translate, distribute, and archive the content across our digital channels. MoveSmooth reserves the absolute right, but does not assume the obligation, to monitor, edit, refuse to post, or permanently delete any User Generated Content that we believe violates these Terms, without notice.</p>

                    <!-- Section 8 -->
                    <h2 id="section-8">8. Intellectual Property Rights</h2>
                    <p>All Content displayed on the Platform, including but not limited to text, software code, graphic elements, sitemaps, brand names, logos, calculator equations, user interface layouts, databases, and trade dress, is the exclusive property of MoveSmooth or its licensors and is protected by United States and international copyright, trademark, patent, and trade secret laws.</p>
                    <p>You may not copy, reproduce, republish, distribute, modify, create derivative works of, publicly display, or sell any Content from MoveSmooth without our express, prior written consent. Any unauthorized use of the Platform's intellectual property represents a material breach of this Agreement and may lead to immediate termination of access and civil or criminal prosecution.</p>

                    <!-- Section 9 -->
                    <h2 id="section-9">9. Disclaimer of Warranties</h2>
                    <p>THE PLATFORM AND ALL CONTENT, SERVICES, CALCULATORS, DIRECTORY LISTINGS, AND RATINGS CONTAINED THEREIN ARE PROVIDED ON AN "AS IS" AND "AS AVAILABLE" BASIS, WITHOUT WARRANTIES OF ANY KIND, EITHER EXPRESS OR IMPLIED. MOVESMOOTH EXPLICITLY DISCLAIMS ALL WARRANTIES, INCLUDING BUT NOT LIMITED TO IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, TITLE, NON-INFRINGEMENT, AND ACCURACY.</p>
                    <p>MOVESMOOTH DOES NOT WARRANT THAT THE PLATFORM WILL OPERATE ERROR-FREE, THAT THE SERVERS OR HOSTING NETWORKS ARE FREE OF VIRUSES OR MALWARE, THAT SECURITY HOLES WILL BE IMMEDIATELY PATCHED, OR THAT THE CONTENT WILL ALWAYS BE CURRENT AND COMPLETE. ANY CALCULATIONS OR PRICE ESTIMATES OBTAINED VIA THE PLATFORM ARE DESIGNED SOLELY FOR COMPARISON PURPOSES, AND YOUR RELIANCE ON THEM IS ENTIRELY AT YOUR OWN RISK.</p>

                    <!-- Section 10 -->
                    <h2 id="section-10">10. Comprehensive Limitation of Liability</h2>
                    <p>TO THE FULLEST EXTENT PERMITTED BY APPLICABLE LAW, IN NO EVENT SHALL MOVESMOOTH, ITS OFFICERS, DIRECTORS, EMPLOYEES, AGENTS, SHAREHOLDERS, OR THIRD-PARTY PROVIDERS BE LIABLE FOR ANY INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, PUNITIVE, OR CONSEQUENTIAL DAMAGES WHATSOEVER. THIS INCLUDES LOSS OF PROFITS, LOSS OF REVENUE, LOSS OF DATA, OR LOSS OF BUSINESS USE, REGARDLESS OF WHETHER SUCH CLAIMS ARE BASED ON CONTRACT, TORT, WARRANTY, STATUTE, OR STRICT LIABILITY.</p>
                    <p>MOVESMOOTH BEARS NO RESPONSIBILITY OR LIABILITY WHATSOEVER FOR DISPUTES, DAMAGE, LOSS, EXTRA CHARGES, LATE ARRIVALS, OR PERSONAL INJURY ASSOCIATED WITH YOUR TRANSACTIONS WITH THIRD-PARTY MOVERS. IF A MOVER DAMAGES YOUR FURNITURE, BREAKS FRAILE ITEMS, CHARGES HELD-HOSTAGE FEES, OR FAILS TO SHOW UP, YOUR LEGAL AND FINANCIAL CLAIMS REMAIN SOLELY AGAINST THAT INDEPENDENT MOVER, NOT MOVESMOOTH. OUR CUMULATIVE LIABILITY FOR ANY CLAIM ARISING OUT OF OR RELATING TO THIS AGREEMENT SHALL NOT EXCEED ONE HUNDRED US DOLLARS ($100.00).</p>

                    <!-- Section 11 -->
                    <h2 id="section-11">11. Indemnification</h2>
                    <p>You agree to indemnify, defend, and hold harmless MoveSmooth, its parent company, subsidiaries, affiliates, officers, directors, employees, agents, and licensors from and against any and all claims, damages, obligations, losses, liabilities, costs, debts, and expenses (including but not limited to reasonable attorney's fees) arising directly or indirectly from:</p>
                    <ul>
                        <li>Your breach or violation of any covenant, representation, or terms of this Agreement.</li>
                        <li>Your use of the Platform and reliance on the moving cost calculators or comparison grids.</li>
                        <li>Any User Generated Content or reviews you post on the Platform.</li>
                        <li>Your violation of any third-party rights, including privacy rights or intellectual property rights.</li>
                        <li>Your interactions, contracts, scheduling, or disputes with any third-party Mover.</li>
                    </ul>

                    <!-- Section 12 -->
                    <h2 id="section-12">12. Dispute Resolution and Governing Law</h2>
                    <p>These Terms of Service and any claim, dispute, or controversy arising out of or relating to this Agreement or your use of the Platform shall be governed by, construed, and enforced in accordance with the laws of the State of Texas, without regard to its conflict of law principles. Any legal action or proceeding arising under this Agreement must be brought exclusively in the state or federal courts located in Travis County, Austin, Texas, and you irrevocably submit to the personal jurisdiction and venue of these courts.</p>
                    <p>TO THE FULLEST EXTENT PERMITTED BY APPLICABLE LAW, YOU AND MOVESMOOTH AGREE THAT ANY DISPUTE RESOLUTION PROCEEDINGS WILL BE CONDUCTED SOLELY ON AN INDIVIDUAL BASIS AND NOT IN A CLASS, CONSOLIDATED, OR REPRESENTATIVE ACTION. YOU WAIVE YOUR RIGHT TO PARTICIPATE IN CLASS ACTION LAWSUITS OR CLASS-WIDE ARBITRATIONS.</p>

                    <!-- Section 13 -->
                    <h2 id="section-13">13. Severability, Entire Agreement, and Waiver</h2>
                    <p>This Agreement, together with the Privacy Policy, Cookie Policy, and any commercial agreements entered into by registered Movers, constitutes the entire and exclusive agreement between you and MoveSmooth regarding your use of the Platform. It supersedes all prior written or oral agreements, understandings, or communications.</p>
                    <p>If any provision of these Terms is deemed invalid, unlawful, void, or unenforceable by a court of competent jurisdiction, that provision shall be severed from the Agreement, and the remaining provisions of these Terms shall remain in full force and effect. No waiver of any term of this Agreement shall be deemed a further or continuing waiver of such term or any other term, and MoveSmooth's failure to assert any right or provision under these Terms shall not constitute a waiver of such right or provision.</p>

                    <!-- Section 14 -->
                    <h2 id="section-14">14. Service Termination and Access Restrictions</h2>
                    <p>MoveSmooth reserves the absolute right, in its sole discretion and without prior warning, liability, or explanation, to terminate, suspend, or restrict your account, user profile, listing permissions, or general access to the Platform. This action may be taken due to a breach of these Terms, suspicious or fraudulent form activity, requests by law enforcement agencies, or security threats. Upon termination, all licenses and rights granted to you under this Agreement shall cease immediately.</p>

                    <!-- Section 15 -->
                    <h2 id="section-15">15. Terms Modifications and Contact Details</h2>
                    <p>We reserve the right to modify, amend, update, or replace these Terms of Service at any time. When modifications are made, we will update the "Last Updated" date at the top of this page. If the modifications are material, we will post a prominent notice on our homepage or send an email to registered users. Your continued use of the Platform following the publication of any changes constitutes your binding acceptance of those changes.</p>
                    <p>If you have any questions, legal inquiries, compliance reports, or request clarifications regarding these Terms of Service, please contact our Legal Operations Team:</p>

                    <div class="card p-4 bg-light border-0 mt-4" style="border-radius: 12px;">
                        <h6 class="fw-bold text-dark mb-2">MoveSmooth Legal Operations</h6>
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
