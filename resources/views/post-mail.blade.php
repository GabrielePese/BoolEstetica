<style media="screen">

    body{
        
        background-color: blue;
        color: white;
        display: flex;
        align-content: center;
        justify-content: center;
    }
    
    </style>
    
    
    <body> 
        <h1>
            ALERT:
            {{$user -> name}} <br>
             {{$action}} <br>
             il post: {{$post -> name}}
        </h1>
        
    </body>