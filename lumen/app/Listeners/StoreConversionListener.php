<?php

namespace App\Listeners;

use App\Events\FormWasSendEvent;
use App\Models\WpPost;
use App\Models\WpTermTaxonomy;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class StoreConversionListener
{
    /**
     * @var WpPost
     */
    private $post;

    /**
     * @var WpTermTaxonomy
     */
    private $term_taxonomy;

    /**
     * Create the event listener.
     *
     * @param WpPost         $post
     * @param WpTermTaxonomy $term_taxonomy
     */
    public function __construct(WpPost $post, WpTermTaxonomy $term_taxonomy)
    {
        $this->post = $post;
        $this->term_taxonomy = $term_taxonomy;
    }

    /**
     * Handle the event.
     *
     * @param  FormWasSendEvent  $event
     * @return void
     */
    public function handle(FormWasSendEvent $event)
    {
        $post = $this->post->create([
            'post_title' => $event->title,
            'post_author' => 1,
            'post_type' => 'conversion',
            'comment_status' => 'closed',
            'ping_status' => 'closed',
        ]);

        $this->add_meta_fields( $post, $event );
        $this->add_term( $post, $event->conversion_key );
    }

    /**
     * @return string
     */
    protected function collect_meta_data() {
        $date = date('Y-m-d H:i:s');
        $result['_DATETIME'] = $date;

        collect($_SERVER)->only('SCRIPT_FILENAME', 'REMOTE_ADDR', 'REMOTE_PORT', 'SERVER_ADDR', 'SERVER_PORT', 'REQUEST_URI', 'HTTP_HOST', 'HTTP_ACCEPT_LANGUAGE', 'HTTP_USER_AGENT', 'REQUEST_TIME_FLOAT', 'HTTP_REFERER', 'HTTP_CONTENT_LENGTH')->toArray();

        if(isset($_REQUEST)) {
            $result['_REQUEST'] = $_REQUEST;
        }

        if(isset($_COOKIE)) {
            $result['_COOKIE'] = $_COOKIE;
        }

        if(isset($_SESSION)) {
            $result['_SESSION'] = $_SESSION;
        }

        $result['_PAYLOAD'] = $this->get_payload();

        return json_encode($result, JSON_PRETTY_PRINT);
    }

    protected function get_payload() {
        $payload = file_get_contents('php://input');
        $decoded_payload = json_decode($payload);

        if(json_last_error() == JSON_ERROR_NONE) {
            return $decoded_payload;
        }

        return $payload;
    }

    /**
     * @param $post
     *
     * @return bool
     */
    protected function add_meta_fields( $post, $event ) {
        $post->meta()->create( [
            'post_id'    => $post->ID,
            'meta_key'   => '_json_log',
            'meta_value' => 'field_5656278b9a8c2',
        ] );

        $post->meta()->create( [
            'post_id'    => $post->ID,
            'meta_key'   => 'json_log',
            'meta_value' => $this->collect_meta_data(),
        ] );

        $post->meta()->create( [
            'post_id'    => $post->ID,
            'meta_key'   => '_mail_html',
            'meta_value' => 'field_56d877f078c73',
        ] );

        $post->meta()->create( [
            'post_id'    => $post->ID,
            'meta_key'   => 'mail_html',
            'meta_value' => $event->email_html,
        ] );

        return true;
    }

    /**
     * @param $post
     * @param $term_slug
     */
    protected function add_term( $post, $term_slug ) {
        $term = \App\Models\WpTerm::where( 'slug', $term_slug )->with( 'taxonomy' )->first();
        if ( $term && is_object( $term->taxonomy ) ) {
            $this->term_taxonomy->find( $term->taxonomy->term_taxonomy_id )->increment( 'count' );
            $post->term()->attach( $term->term_id );
        }
    }
}
