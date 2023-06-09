<div class="dash-content">
    <div class="title heading">
        <span class="text">Animals</span>

       <a href="./animal/add"> <button type="button" class="btn btn-primary">Add Animal</button></a>
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
    $(document).ready(() => {
        $.ajax({
            url: './animal/get_animals',
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
    })
</script>
