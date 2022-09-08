<!DOCTYPE html>

<head>
    <title>Real Time Monitoring and Logging</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        // USER YOUR PUSHER CREDENTIAL
        var pusher = new Pusher('<YOUR-KEY>', {
            cluster: 'ap1'
        });

        // THE CHANNEL AND EVENT COMING FROM THE pusher.php
        var channel = pusher.subscribe('my-channel');
        channel.bind('event-update-rtm', function(data) {
            console.log(data);
            
            // Store the selector element to variable.
            var agent_card = $("#board").find(`[data-agent-id='${data.agent_id}'] #agent_name`);
            var agent_status = $("#board").find(`[data-agent-id='${data.agent_id}'] #status`);
            
            // Set the text from data
            agent_card.text(data.agent_name);
            agent_status.text(data.status);

            // Clear span badge class
            agent_status.removeClass();

            // Set Badge Color
            if(data.status=="ON") string_class = "badge bg-warning rounded-pill";
            else if(data.status=="BREAK") string_class = "badge bg-danger rounded-pill";
            else if(data.status=="CALLING") string_class = "badge bg-success rounded-pill";
            else string_class = "badge bg-primary rounded-pill";

            // Apply class badge
            agent_status.addClass(string_class);
        });
    </script>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">PHP Pusher</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">RTM</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section>
        <div class="container mt-2">
            <!-- The data inside this element board will be coming from the initial loading of real time data. -->
            <ul id="board" class="list-group">
                <li data-agent-id="1" class="list-group-item d-flex justify-content-between align-items-center">
                    <span id="agent_name">Agent 1</span>
                    <span id="status" class="badge bg-secondary rounded-pill">OFF</span>
                </li>
                <li data-agent-id="2" class="list-group-item d-flex justify-content-between align-items-center">
                    <span id="agent_name">Agent 2</span>
                    <span id="status" class="badge bg-secondary rounded-pill">OFF</span>
                </li>
                <li data-agent-id="3" class="list-group-item d-flex justify-content-between align-items-center">
                    <span id="agent_name">Agent 3</span>
                    <span id="status" class="badge bg-secondary rounded-pill">OFF</span>
                </li>
            </ul>
        </div>
    </section>
</body>

</html>