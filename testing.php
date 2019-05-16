<?php
    $Title = 'String Operations';
	include('html/header.php'); ?>

<?php
    
    echo getUserIP();
    echo '<br>';
    echo "\n";
    echo getURL();
    echo '<br>';
    echo "\n";
    
    
    echo '<table>';
    echo "\n";
    
    echo '<tr>';
    echo '<th>';
    echo 'String';
    echo '</th>';
    echo '<th>';
    echo 'Function';
    echo '</th>';
    echo '<th>';
    echo 'Result';
    echo '</th>';
    echo '</tr>';
    echo "\n";
    
    $testingUsername = 'mario_1997';
    $testingEmail = 'mr.koshnicharov@gmail.com';
    $testingPhone = '0886924362';
    
    echo '<tr>';
    echo '<td>';
    echo $testingUsername;
    echo '</td>';
    echo '<td>';
    echo 'length($test, 6, 3)';
    echo '</td>';
    echo '<td>';
    echo length($testingUsername, 6, 3);
    echo '</td>';
    echo '</tr>';
    echo "\n";
    
    echo '<tr>';
    echo '<td>';
    echo $testingUsername;
    echo '</td>';
    echo '<td>';
    echo 'length($test, 32, 3)';
    echo '</td>';
    echo '<td>';
    echo length($testingUsername, 32, 3);
    echo '</td>';
    echo '</tr>';
    echo "\n";
    
    echo '<tr>';
    echo '<td>';
    echo $testingUsername;
    echo '</td>';
    echo '<td>';
    echo 'length($test, 32, 16);';
    echo '</td>';
    echo '<td>';
    echo length($testingUsername, 32, 16);
    echo '</td>';
    echo '</tr>';
    echo "\n";
    
    echo '<tr>';
    echo '<td>';
    echo $testingUsername;
    echo '</td>';
    echo '<td>';
    echo 'validUsername';
    echo '</td>';
    echo '<td>';
    echo validUsername($testingUsername);
    echo '</td>';
    echo '</tr>';
    echo "\n";
    
    echo '<tr>';
    echo '<td>';
    echo $testingEmail;
    echo '</td>';
    echo '<td>';
    echo 'validEmail';
    echo '</td>';
    echo '<td>';
    echo validEmail($testingEmail);
    echo '</td>';
    echo '</tr>';
    echo "\n";
    
    echo '<tr>';
    echo '<td>';
    echo $testingPhone;
    echo '</td>';
    echo '<td>';
    echo 'validPhone';
    echo '</td>';
    echo '<td>';
    echo validPhone($testingPhone);
    echo '</td>';
    echo '</tr>';
    echo "\n";
    
    $testingUsername = 'марио_1997';
    $testingEmail = 'марио.koshnicharov@gmail.com';
    $testingPhone = '0886924362b';
    
    echo '<tr>';
    echo '<td>';
    echo $testingUsername;
    echo '</td>';
    echo '<td>';
    echo 'validUsername';
    echo '</td>';
    echo '<td>';
    echo validUsername($testingUsername);
    echo '</td>';
    echo '</tr>';
    echo "\n";
    
    echo '<tr>';
    echo '<td>';
    echo $testingEmail;
    echo '</td>';
    echo '<td>';
    echo 'validEmail';
    echo '</td>';
    echo '<td>';
    echo validEmail($testingEmail);
    echo '</td>';
    echo '</tr>';
    echo "\n";
    
    echo '<tr>';
    echo '<td>';
    echo $testingPhone;
    echo '</td>';
    echo '<td>';
    echo 'validPhone';
    echo '</td>';
    echo '<td>';
    echo validPhone($testingPhone);
    echo '</td>';
    echo '</tr>';
    echo "\n";
    
    $testingUsername = 'mario_____1997';
    $testingEmail = 'koshnicharov@gmail.c';
    $testingPhone = 'b0886924362';
    
    echo '<tr>';
    echo '<td>';
    echo $testingUsername;
    echo '</td>';
    echo '<td>';
    echo 'validUsername';
    echo '</td>';
    echo '<td>';
    echo validUsername($testingUsername);
    echo '</td>';
    echo '</tr>';
    echo "\n";
    
    echo '<tr>';
    echo '<td>';
    echo $testingEmail;
    echo '</td>';
    echo '<td>';
    echo 'validEmail';
    echo '</td>';
    echo '<td>';
    echo validEmail($testingEmail);
    echo '</td>';
    echo '</tr>';
    echo "\n";
    
    echo '<tr>';
    echo '<td>';
    echo $testingPhone;
    echo '</td>';
    echo '<td>';
    echo 'validPhone';
    echo '</td>';
    echo '<td>';
    echo validPhone($testingPhone);
    echo '</td>';
    echo '</tr>';
    echo "\n";
    
    $testingUsername = 'MaRiO_1997';
    $testingEmail = 'koshnicharov@gmail.';
    $testingPhone = '0886 92 43 62';
    
    echo '<tr>';
    echo '<td>';
    echo $testingUsername;
    echo '</td>';
    echo '<td>';
    echo 'validUsername';
    echo '</td>';
    echo '<td>';
    echo validUsername($testingUsername);
    echo '</td>';
    echo '</tr>';
    echo "\n";
    
    echo '<tr>';
    echo '<td>';
    echo $testingEmail;
    echo '</td>';
    echo '<td>';
    echo 'validEmail';
    echo '</td>';
    echo '<td>';
    echo validEmail($testingEmail);
    echo '</td>';
    echo '</tr>';
    echo "\n";
    
    echo '<tr>';
    echo '<td>';
    echo $testingPhone;
    echo '</td>';
    echo '<td>';
    echo 'validPhone';
    echo '</td>';
    echo '<td>';
    echo validPhone($testingPhone);
    echo '</td>';
    echo '</tr>';
    echo "\n";
    
    $testingUsername = 'MaRiO_____1 9  9   7';
    $testingEmail = 'koshnicharov @ gmail.com';
    $testingPhone = '0886 92 43 62';
    
    echo '<tr>';
    echo '<td>';
    echo $testingUsername;
    echo '</td>';
    echo '<td>';
    echo 'toKey';
    echo '</td>';
    echo '<td>';
    echo toKey($testingUsername);
    echo '</td>';
    echo '</tr>';
    echo "\n";
    
    echo '<tr>';
    echo '<td>';
    echo $testingEmail;
    echo '</td>';
    echo '<td>';
    echo 'toKey';
    echo '</td>';
    echo '<td>';
    echo toKey($testingEmail);
    echo '</td>';
    echo '</tr>';
    echo "\n";
    
    echo '<tr>';
    echo '<td>';
    echo $testingPhone;
    echo '</td>';
    echo '<td>';
    echo 'toKey';
    echo '</td>';
    echo '<td>';
    echo toKey($testingPhone);
    echo '</td>';
    echo '</tr>';
    echo "\n";
    
    echo '<tr>';
    echo '<td>';
    echo $testingUsername;
    echo '</td>';
    echo '<td>';
    echo 'preventRepeating';
    echo '</td>';
    echo '<td>';
    echo preventRepeating($testingUsername);
    echo '</td>';
    echo '</tr>';
    echo "\n";
    
    echo '<tr>';
    echo '<td>';
    echo $testingUsername;
    echo '</td>';
    echo '<td>';
    echo 'preventRepeating toKey';
    echo '</td>';
    echo '<td>';
    echo preventRepeating(toKey($testingUsername));
    echo '</td>';
    echo '</tr>';
    echo "\n";
    
    
    echo '</table>';
?>

<?php include('html/footer.php'); ?>