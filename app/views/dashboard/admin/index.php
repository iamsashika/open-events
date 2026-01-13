<?php

authorize('admin');

?>


<h1>Admin Dashboard</h1>
<p>Welcome, Admin; <?= htmlspecialchars($_SESSION['user']['first_name']); ?> </p>

<ul>
    <li><a href="<?php echo url('/dashboard/admin/users'); ?>">Manage Users</a></li>
    <li><a href="<?php echo url('/dashboard/admin/events'); ?>">Manage Events</a></li>
    <li><a href="<?php echo url('/dashboard/admin/venues'); ?>">Manage Venues</a></li>
</ul>