{{ content() }}

<div class="col-md-6">
    <div>
        <form action={{ url('team/member/send') }} method="post">
            <div class="form-group">
                <label for="email">talent email:</label>
                {{ email_field("email", "class": "form-control", "placeholder": "Email", "required": "required") }}
            </div>
            <div class="form-group">
                <label for="position">Invite as:</label>
                {{ text_field("position", "class": "form-control", "placeholder": "Position", "required": "required") }}
            </div>
            <div class="form-group">
                {{ check_field("is_admin") }}
                <label for="is_admin"> As Admin</label>
            </div>
            <button type="submit">Invite to Team</button>
        </form>
    </div>
</div>