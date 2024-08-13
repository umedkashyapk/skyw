<style>
    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 10px;
    }

    th {
        background-color: #f2f2f2;
    }
</style>

<h2>User Investment Data</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Name</th>
        <th>Investment($)</th>
        <th>Income($)</th>
        <th>Used Fund($)</th>
        <th>New Package($)</th>
    </tr>
    <?php foreach ($users as $id => $user) : ?>
        <tr>
            <td><?php echo htmlspecialchars($id); ?></td>
            <td><?php echo htmlspecialchars($user['username']); ?></td>
            <td><?php echo htmlspecialchars($user['name']); ?></td>
            <td><?php echo htmlspecialchars($user['investment']); ?></td>
            <td><?php echo htmlspecialchars($user['income']); ?></td>
            <td><?php echo htmlspecialchars($user['usedFund']); ?></td>
            <td><?php echo htmlspecialchars($user['newPackage']); ?></td>
        </tr>
    <?php endforeach; ?>
</table>