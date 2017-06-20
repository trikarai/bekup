{{ content() }}
<div>
    <a href={{url('team/idea/new')}}> propose idea </a>
</div>
<div class="box">
    <table class="table table-hover">
        <thead>
            <tr>
                <td>Idea</td>
                <td>Description</td>
                <td colspan="2">Action</td>
            </tr>
        </thead>
        <tbody>
			{% if ideaRdos is empty %}
			<tr>
				<h2>No Idea Data</h2>
			</tr>
			{% endif %}
            {% for rdo in ideaRdos %}
                <tr>
                    <td> {{rdo.getName()}}</td>
                    <td> {{rdo.getDescription()}}</td>
                    <td data-title="Action">
                        <a href="{{url('team/idea/edit/')}}{{rdo.getId()}}" class="btn tomboledit">Edit</a>
                    </td>
                    <td>
                        <a href="{{url('team/idea/remove/')}}{{rdo.getId()}}" class="btn tomboledit">Remove</a>
                    </td>
                </tr>
            {% endfor %}
        </tbody>
    </table>
</div>