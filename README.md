About last changes

Since I have used 9.35 version of Laravel and mix don't work with that version, 
I have changed some config after installation vite and for views use blade, not vue.

Layouts

1. All project work with one <auth.blade> layout.

Login and registration
1. view: <auth.login> and <auth.register> blades
2. for login and registration with social media used function from the <AuthenticatedSessionController.php>
3. for checking the updated email was used <AuthenticatedSessionController@update> function and <admin.user> blade for view

Dashboard

1. after login work <dashboard.blade>
2. for category and product work blades from same folders
3. from template, I change </public/assets/js/material-dashboard.js> <showSwal function> with type <warning_message_and_cancel> for delete modal
