{{ content() }}
<div>
    <a href={{url('talent/entrepreneurship/new')}}> Add Entrepreneurship Experience </a>
</div>
<div class="box">
    <table class="table table-hover">
        <thead>
            <tr>
                <td>Entrepreneurship</td>
                <td>Field</td>
                <td>Category</td>
                <td>Position</td>
                <td>Start Year</td>
                <td>End Year</td>
                <td colspan="2">Action</td>
            </tr>
        </thead>
        <tbody>
			{% if rdos is empty %}
			<tr>
				<h2>No Entrepreneurship Data</h2>
			</tr>
			{% endif %}
            {% for rdo in rdos %}
                <tr>
                    <td> {{rdo.getName()}}</td>
                    <td> {{rdo.getBusinessField()}}</td>
                    <td> {{rdo.getBusinessCategory()}}</td>
                    <td> {{rdo.getPosition()}}</td>
                    <td> {{rdo.getStartYear()}}</td>
                    <td> {{rdo.getEndYear()}}</td>
                    <td data-title="Action">
                        <a href="{{url('talent/entrepreneurship/edit/')}}{{rdo.getId()}}" class="btn tomboledit">Edit</a>
                    </td>
                    <td>
                        <a href="{{url('talent/entrepreneurship/remove/')}}{{rdo.getId()}}" class="btn tomboledit">Remove</a>
                    </td>
                </tr>
            {% endfor %}
        </tbody>
    </table>
</div>