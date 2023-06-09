<div class="dash-content">
    <div class="title">
        <span class='text'>Add Animal:</span>
        <h5 class="foooo" id="msg" style="color:green; margin-left:10px;"></h5>
    </div>
    <form class="light">
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Price: </label>
            <div class="col-sm-8">
                <input id="price" type="email" class="search_input" placeholder="Enter price">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Select species:</label>
            <div class="col-sm-8">
                <select name="species" id="species" class='search_input'>
                    <option value="american">american</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Select Group:</label>
            <div class="col-sm-8">
                <select name="species" id="group" class='search_input'>
                    <option value="G1">G1</option>
                    <option value="G2">G2</option>
                    <option value="G3">G3</option>
                </select>
            </div>
        </div>

        <fieldset class="form-group">
            <div class="row my-3">
                <legend class="col-form-label col-sm-2 pt-0">Is it healthy: </legend>
                <div class="col-sm-8">
                    <div class="form-check">
                        <input value="yes" class="form-check-input" type="radio" name="pg" id="gridRadios1"
                            value="option1" checked>
                        <label class="form-check-label" for="gridRadios1">
                            Yes
                        </label>
                    </div>
                    <div class="form-check">
                        <input values="no" class="form-check-input" type="radio" name="pg" id="gridRadios2"
                            value="option2">
                        <label class="form-check-label" for="gridRadios2">
                            No
                        </label>
                    </div>
                </div>
            </div>

            <div class="row my-3">
                <legend class="col-form-label col-sm-2 pt-0">Is it healthy: </legend>
                <div class="col-sm-8">
                    <div class="form-check">
                        <input value="yes" class="form-check-input" type="radio" name="healthy" id="health1"
                            value="option1" checked>
                        <label class="form-check-label" for="health1">
                            Yes
                        </label>
                    </div>
                    <div class="form-check">
                        <input value="no" class="form-check-input" type="radio" name="healthy" id="health2"
                            value="option2">
                        <label class="form-check-label" for="health2">
                            No
                        </label>
                    </div>
                </div>
            </div>

        </fieldset>

        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" id="submit" class="btn btn-primary">Add</button>
            </div>
        </div>
    </form>
</div>

<script>
    $("#submit").on('click', event => {
        event.preventDefault();

        let price = $("#price").val();
        let species = $("#species").val();
        let group = $('#group').val();
        let is_healthy = $("input[name='healthy']:checked").val();
        let is_pregnant = $("input[name='pg']:checked").val();

        let data = new FormData();
        data.append("price", price);
        data.append("species", species);
        data.append("group", group);
        data.append("healthy", is_healthy);
        data.append("pregnant", is_pregnant);

        $.ajax({
            url: './add/insert',
            data: data,
            method: "POST",
            contentType: false,
            processData: false,
            success: (message) => {
                $("#msg").text("Added sucessfully");
                setTimeout(() => {
                    $("#msg").text("");
                }, 1000 * 2);

                $("form").clear();
            },
            error: (error) => {
                console.log(error);
            }
        })

    })
</script>
