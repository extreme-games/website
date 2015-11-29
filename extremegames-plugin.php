<?php
/*
Plugin Name: Extreme Games Widgets
Description: This plugin enables different points, jp, and elo widgets.
*/
/* Start Adding Functions Below this Line */

/* Create the widget */

add_action( 'widgets_init', 'src_load_widgets' );

function src_load_widgets() {
    register_widget( 'eg_toppoints' );
    register_widget( 'eg_topduelelo' );
	register_widget( 'eg_topbdelo' );
	register_widget( 'current_jackpot' );
}

class eg_toppoints extends WP_Widget {
    function __construct() {
parent::__construct(
// Base ID of your widget
'eg_toppoints', 

// Widget name will appear in UI
__('EG Top Points', 'eg_toppoints_domain'), 

// Widget description
array( 'description' => __( 'Diplays Top Points in Pub', 'eg_toppoints_domain' ), ) 
);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];

// This is where you run the code and display the output
// Create connection
//INCLUDE THE REQUIRED SQL CONNECTION FILE HERE
$conn = new mysqli($host, $username, $password, $dbname, $port);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "CALL Pub_CurrentTopPoints(5)";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th align='left'>Name</th><th>Points</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["Name"]."</td><td>".$english_format_number = number_format($row["Points"])."</td></tr>";
    }
    echo "</table>";
    echo "<font style='font-size:10px; color:#000;'>*stats since last reset.</font>";
	echo "</aside>";
} else {
    echo "0 results";
	echo "</aside>";
}
$conn->close();
}
		
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'EG Top Points', 'eg_toppoints_domain' );
}
// Widget admin form
?>

<p>
  <label for="<?php echo $this->get_field_id( 'title' ); ?>">
    <?php _e( 'Title:' ); ?>
  </label>
  <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<?php 
}
	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
return $instance;
}
} // Class eg_toppoints ends here

class eg_topduelelo extends WP_Widget {
    function __construct() {
parent::__construct(
// Base ID of your widget
'eg_topduelelo', 

// Widget name will appear in UI
__('EG Top Duel ELO', 'eg_topduelelo_domain'), 

// Widget description
array( 'description' => __( 'Diplays Top Duel ELO', 'eg_topduelelo_domain' ), ) 
);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];

// This is where you run the code and display the output
// Create connection
//INCLUDE THE REQUIRED SQL CONNECTION FILE HERE
$conn = new mysqli($host, $username, $password, $dbname, $port);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "CALL Duel_TopElo(5)";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th align='left'>Name</th><th>ELO</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["Name"]."</td><td>".$row["Elo"]."</td></tr>";
    }
    echo "</table>";
	echo "</aside>";
} else {
    echo "0 results";
	echo"</aside>";
}
$conn->close();
}
		
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'EG Top Duel ELO', 'eg_topduelelo_domain' );
}
// Widget admin form
?>
<p>
  <label for="<?php echo $this->get_field_id( 'title' ); ?>">
    <?php _e( 'Title:' ); ?>
  </label>
  <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<?php 
}
	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
return $instance;
}
}
 // Class eg_topduelelo ends here
 class eg_topbdelo extends WP_Widget {
    function __construct() {
parent::__construct(
// Base ID of your widget
'eg_topbdelo', 

// Widget name will appear in UI
__('EG Top BD ELO', 'eg_topbdelo_domain'), 

// Widget description
array( 'description' => __( 'Diplays Top BD ELO', 'eg_topbdelo_domain' ), ) 
);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];

// This is where you run the code and display the output
// Create connection
//INCLUDE THE REQUIRED SQL CONNECTION FILE HERE
$conn = new mysqli($host, $username, $password, $dbname, $port);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "CALL BaseDuel_TopElo(5)";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th align='left'>Name</th><th>ELO</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["Name"]."</td><td>".$row["Elo"]."</td></tr>";
    }
    echo "</table>";
	echo "</aside>";
} else {
    echo "0 results";
	echo "</aside>";
}
$conn->close();
}
		
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'EG Top BD ELO', 'eg_topbdelo_domain' );
}
// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<?php 
}
	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
return $instance;
}
}
 // Class current_jackpot ends here
 class current_jackpot extends WP_Widget {
    function __construct() {
parent::__construct(
// Base ID of your widget
'current_jackpot', 

// Widget name will appear in UI
__('Current Jackpot', 'current_jackpot_domain'), 

// Widget description
array( 'description' => __( 'Diplays Current Jackpot', 'current_jackpot_domain' ), ) 
);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];

// This is where you run the code and display the output
// Create connection
//INCLUDE THE REQUIRED SQL CONNECTION FILE HERE
$conn = new mysqli($host, $username, $password, $dbname, $port);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "CALL Pub_CurrentJackpot()";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "&nbsp;";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<div class='jackpot'><span style='color:#000'>Current JP&nbsp;:&nbsp;</span>".$row["Jackpot"];
    }
	echo "</div>";
	echo "</aside>";
} else {
    echo "0 results";
	echo "</aside>";
}
$conn->close();
}
		
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'Current Jackpot', 'current_jackpot_domain' );
}
// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<?php 
}
	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
return $instance;
}
}

?>
