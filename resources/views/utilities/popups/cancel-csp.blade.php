<pop-up id="alert">
<div class="csp-main">
    <div class="prompt">
        <h5>Account Deletion Alert</h5>
    </div>
   <div class="csp-contents">
    <div class="csp-details">
        <p>Are you sure you want to delete all data you've provided so far on our {{ config('app.name') }} system. Click on the delete button to confirm your action. Or click on click on cancel if this was a mistake.</p>
    </div>
    <div class="csp-action-btn">
        <div class="delete btn">
            <button onclick="window.location.href='{{ route('delete-user-signupData', ['email' => $email]) }}'"><i class="icofont-bin"></i>&nbsp;Delete</button>
        </div>
        <div class="cancel btn">
            <button onclick="window.location.href='#'"><i class="icofont-close"></i>&nbsp;Cancel</button>
        </div>
    </div>
   </div>
</div>
</pop-up>