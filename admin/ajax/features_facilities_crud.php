<?php
    require_once('../db/db_config.php');
    require_once('../include/essentials.php');
    adminLogin();

    if (isset($_POST['add_feature'])){
        $frm_data = filteration($_POST);

        $q = "INSERT INTO `features`(`name`) VALUES (?)";
        $values = [$frm_data['feature_name']];
        $res = insert($q, $values, "s");
        echo $res;
    }

    if (isset($_POST['get_features'])){
        $res = selectAll('features');
        $i = 1;
        if (mysqli_num_rows($res) == 0) {
            echo <<<HTML
                <tr>
                    <td colspan="7" class="text-center text-muted" style="height: 300px; vertical-align: middle;">
                        No features found.
                    </td>
                </tr>                                            
            HTML;
        }

        while ($row = mysqli_fetch_assoc($res)) {
            echo <<<data
                <tr>
                    <th scope="row">{$i}</th>
                    <td>{$row['name']}</td>
                    <td>
                        <button type="button" onclick="delete_feature($row[sl_no])" class="btn btn-danger btn-sm shadow-none">
                            <i class="bi bi-trash me-1"></i>
                            Delete
                        </button>
                    </td>
                </tr>
            data;
            $i++;
        }
    }

    if (isset($_POST['delete_feature'])){
        $frm_data = filteration($_POST);
        $values= [$frm_data['delete_feature']];
        $q = "DELETE FROM `features` WHERE `sl_no`=?";
        $res = delete($q, $values, "i");
        echo $res;
    }
?>
