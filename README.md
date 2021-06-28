# Soul.Pay
A website for a Bank with complete signup/login, verification, admin dashboard, user dashboard , money transfer systems and much more.

Comprehensive list of features:
    <ol>
    <li>sign up, login and complete authentication system</li>
    <li>a user verification system where users have to upload their identity documents</li>
    <li>an admin system where admins can view these documents and block/verify users.</li>
    <li>user dashboard system which includes:
        <ul type="disc">
        <li>A user profile view section</li>
        <li>Perform moeny transfers to other users</li>
        <li>Transaction history</li>
        <li>Transaction history pdf generation</li>
        <li>New debit card application system</li>
        </ul>
    </li>
    <li>A contact us, about us, services page.</li>
    </ol>

The website is now live on Education-Host and you can [check it out here.](http://soul.pay.educationhost.cloud/)

The app doesn't have any dependencies but you will have to configure:
    <ol>
    <li>database according to your system in `DBCONFIG/dbconfig.php`.</li>
    <li>All ajax.open() GET link href inside `findAtmBranches.php`, `dashboard.js`, `dropdown.js`. ( change http:<span></span>//localhost/Soulbank/... to http:<span></span>//localhost/Your_folder_name/... ) </li>
    <li>All require_once and href in INCLUDES and ADMIN. ( change require_once($_SERVER['DOCUMENT_ROOT']."/Soulbank/...) to require_once($_SERVER['DOCUMENT_ROOT']."/Your_folder_name/... ))</li>
    </ol>
