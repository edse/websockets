var Server;

function log( text ) {
  $log = $('#log');
  //Add text to log
  $log.append(($log.val()?"\n":'')+text);
  //Autoscroll
  $log[0].scrollTop = $log[0].scrollHeight - $log[0].clientHeight;
}

function send( text ) {
  Server.send( 'message', text );
}

$(document).ready(function() {
  log('Connecting...');
  Server = new FancyWebSocket('ws://http://websockets.possum-cms.com:19325');

  $('#message').keypress(function(e) {
    if ( e.keyCode == 13 && this.value ) {
      log( 'You: ' + this.value );
      send( this.value );

      $(this).val('');
    }
  });

  //Let the user know we're connected
  Server.bind('open', function() {
    log( "Connected." );
  });

  //OH NOES! Disconnection occurred.
  Server.bind('close', function( data ) {
    log( "Disconnected." );
  });

  //Log any messages sent from server
  Server.bind('message', function( payload ) {
    log( payload );
  });

  Server.connect();
});
