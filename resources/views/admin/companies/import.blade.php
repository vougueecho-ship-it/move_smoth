@extends('layouts.admin')

@section('title', 'Bulk Import Companies | Admin Dashboard')
@section('page_title', 'Bulk Import Moving Companies')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header bg-white border-0 py-3">
                <h4 class="fw-bold mb-0">Bulk Import Companies from Excel / CSV</h4>
            </div>
            <div class="card-body p-4">
                <div class="alert alert-info border-0 rounded-3 p-4 mb-4">
                    <h5 class="fw-bold mb-2"><i class="fas fa-info-circle me-2"></i> How to prepare your Excel file:</h5>
                    <ol class="mb-0 lh-lg">
                        <li>Open your Excel file of companies.</li>
                        <li>Go to <strong>File > Save As</strong>, select the location, and choose <strong>CSV (Comma delimited) (*.csv)</strong> as the file format.</li>
                        <li>Ensure the CSV file includes the following columns (headers) so they map automatically:
                            <div class="mt-2 table-responsive">
                                <table class="table table-sm table-bordered bg-white text-dark mb-0">
                                    <thead>
                                        <tr class="table-light text-center small fw-bold">
                                            <th>Excel Header</th>
                                            <th>Target Database Field</th>
                                            <th>Description / Example</th>
                                        </tr>
                                    </thead>
                                    <tbody class="small">
                                        <tr>
                                            <td class="fw-bold">Company Name <span class="text-danger">*</span></td>
                                            <td><code>name</code></td>
                                            <td>The business name of the moving company (e.g. <em>Flexdolly Moving & Delivery</em>).</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Company Email</td>
                                            <td><code>email</code></td>
                                            <td>The business email (e.g. <em>admin@flexdolly.com</em>).</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Company Address <span class="text-danger">*</span></td>
                                            <td><code>address_line1</code> & <code>city</code></td>
                                            <td>The street address containing a <strong>5-digit ZIP code</strong> (e.g. <em>95 Pleasant Hill Rd, Unit I, Scarborough, ME 04074</em>). The ZIP is used to automatically map the correct City and State in the database.</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Company State</td>
                                            <td><code>state_id</code> (Fallback)</td>
                                            <td>The state name or code (e.g. <em>California</em> or <em>CA</em>). Used as a backup if no ZIP code is found in the address.</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">D.O.T No</td>
                                            <td><code>dot_number</code></td>
                                            <td>The USDOT safety regulation number (e.g. <em>4329208</em>).</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Phone No</td>
                                            <td><code>phone</code></td>
                                            <td>The company's primary contact number (e.g. <em>858-733-0775</em>).</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Create Date</td>
                                            <td><code>created_at</code></td>
                                            <td>Initial insertion date (e.g. <em>27-12-2025</em>). Falls back to current date if missing.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </li>
                    </ol>
                </div>

                @if(session('error'))
                    <div class="alert alert-danger border-0 rounded-3 mb-4">
                        <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('admin.companies.import.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-4 align-items-end">
                        <div class="col-md-8">
                            <label class="form-label fw-bold text-dark fs-5 mb-2">Select CSV File</label>
                            <input type="file" name="csv_file" class="form-control form-control-lg border-2 border-primary-subtle" accept=".csv" required>
                            <div class="form-text text-muted small mt-2">
                                <i class="fas fa-file-csv me-1"></i> Supported file format: <code>.csv</code> (Comma delimited). Maximum file size: 10MB.
                            </div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold rounded-3 py-2-5"><i class="fas fa-file-import me-2"></i> Start Importing</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="fw-bold mb-0"><i class="fas fa-shield-alt text-success me-2"></i> Smart Safety & De-duplication Features</h5>
            </div>
            <div class="card-body p-4 pt-0 lh-lg text-muted small">
                <ul class="mb-0 ps-3">
                    <li><strong>Automatic Zip-code Mapping:</strong> The importer parses addresses looking for a ZIP code. It queries your 33k+ cities list to automatically assign the perfect City and State ID so there are no broken references.</li>
                    <li><strong>Idempotent Imports (No Duplicates):</strong> If a company already exists with the same <strong>D.O.T Number</strong> or <strong>Company Email</strong>, its record will be updated with the latest details instead of inserting a duplicate!</li>
                    <li><strong>Automated Slug Generation:</strong> Beautiful, dynamic search-engine friendly slugs (e.g. <code>/company/flexdolly-moving-delivery</code>) are auto-generated from company names.</li>
                    <li><strong>Dynamic SEO Meta Generation:</strong> Newly imported companies instantly receive beautifully optimized, dynamic meta tags for their profiles!</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
