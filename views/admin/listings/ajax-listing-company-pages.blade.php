<table id="listing_company_tbl" class="table table-bordered table-hover ">
    <thead>
        <tr>
            <th>No.</th>
            <th>Company name</th>
            <th>Status</th>
            <th>Action</th>

        </tr>
    </thead>
    <tbody>
        @php
        $i = 1;
        @endphp
        @if(!empty($getListingDetail->companyInListing))
        @foreach ($getListingDetail->companyInListing as $companiesData)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $companiesData->onecompany->company_name }}</td>
            <td>{{ ucfirst($companiesData->onecompany->company_status) }}</td>
            <td>
                <a href="{{ route('companies.show', $companiesData->id) }}" type="button"
                    class="btn ipfs-button">View</a>
                
            </td>
        </tr>

        @endforeach
        @else
        <tr class="no-data-row">
            <td colspan="5" rowspan="2" align="center">
                <div class="message">
                    <p>No data available in table</p>
                </div>

            </td>
        </tr>
        @endif
    </tbody>

</table>