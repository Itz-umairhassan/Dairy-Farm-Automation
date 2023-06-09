<?php

require_once('./Backend/Helpers.php');
$help = new Helper();
$str = $_SERVER['QUERY_STRING'];

echo $str;
$str = $help->parser($str);

?>

<div class="dash-content">
    <div class="title heading">
        <span class="text">Animals</span>

        <div>
            <select class="drop light mx-3" name="" id="types">
                <?php
                // some php code to setup the filters on the bases of the query string....
                $options = ["All", "Healthy", "Unhealthy", "pregnant"];

                if (isset($str['type'])) {
                    echo '<option value="' . $str['type'] . '"> ' . $str['type'] . ' </option>';
                }
                for ($i = 0; $i < 4; $i++) {
                    if (strtolower($options[$i]) !== strtolower($str['type'])) {
                        echo '<option value="' . $options[$i] . '"> ' . $options[$i] . ' </option>';
                    }
                }
                ?>
            </select>
            <a href="./animal/add"> <button type="button" class="btn btn-primary">Add Animal</button></a>

        </div>

    </div>

    <table class="table align-middle mb-0 light">
        <thead class="light">
            <tr>
                <th>ID</th>
                <th>Species</th>
                <th>Price</th>
                <th>Group</th>
                <th>Condition</th>
            </tr>
        </thead>
        <tbody id="table_body">


        </tbody>
    </table>

</div>

<script>

    function make_request() {
        $.ajax({
            url: `./animal/get_animals?type=${$("#types").val()}`,
            method: "GET",
            contentType: false,
            processData: false,
            success: (data) => {
                let result = JSON.parse(data);
                let html_data = ``;

                result.forEach(obj => {
                    html_data += `
                <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="ms-3">
                            <p class="fw-bold mb-1">${obj.ID}</p>
                        </div>
                    </div>
                </td>
                <td>
                    <p class="fw-normal mb-1">${obj.species}</p>
                </td>
                <td>${obj.price}</td>
                <td>
                    <button type="button" class="btn btn-link btn-sm btn-rounded">
                        ${obj.group}
                    </button>
                </td>
                <td>
                    <span class="badge badge-${obj.healthy == 1 ? 'success' : 'danger'} rounded-pill d-inline">${obj.healthy == 1 ? 'Healthy' : 'Unhealthy'}</span>
                </td>


            </tr>
                `;
                });

                // now set it into the table body;
                $("#table_body").html(html_data);
            },
            error: (error) => {
                console.log(error);
            }
        })
    }

    $(document).ready(() => {
        $("#types").change(() => {
            make_request();
        })

        make_request();

    })
</script>
