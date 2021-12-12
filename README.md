# ryangurnick

this application is intended to help with personal website management. it will provide a variety of functionality to aid in setting up a simplistic website that contains a variety of information about a person and their respective interests.

## functionality
1. management of custom pages
    1. create, update, read, and delete pages
    2. draft mode, that requires authentication in order to view
2. gallery for photos
    1. single/multiple gallery system
    2. metadata attachment process (location, date & time, people, notes)
    3. comment system (can be enabled or disabled)
       1. prohibited words
    4. reactions (can be enabled or disabled)
3. resume builder
4. storage management
5. viewer analytics
    1. http agent
    2. page loads
    3. unique views
    4. click tracking
6. settings
    1. toggle maintenance mode
    2. configure security
    3. laravel configuration management
        * website name
        * disk locations
        * database configuration (view only)
        * cors management
        * authentication management
            * password timeout
            * lockout durations

## data structures
all the tables should be assumed to have a created_at and updated_at timestamp without it being specified in the data structures listed below. additionally, all parent models (ie models that are related to other models but are the source of a foreign key) will be updated when a child model is updated however they will not be deleted if the child is deleted.

### first party tables

#### emails (App\Models\Email)
* id (unsigned big integer)
* class (string)
* to (string)
* message (long text)
* parameters (text) [nullable]
* read (boolean)

#### galleries (App\Models\Gallery)
* id (unsigned big integer)
* name (string)
* description (string)

#### gallery comments (App\Models\GalleryComment)
* id (unsigned big integer)
* gallery_image_id (unsigned big integer)
* user_id (unsigned big integer)
* session_id (unsigned big integer)
* message (text)

#### gallery images (App\Models\GalleryImage)
* id (unsigned big integer)
* gallery_id (unsigned big integer)
* image_id (unsigned big integer)
* caption (string)
* date (datetime) [default: current_timestamp()]
* location (text)
* people (text)
* visible (boolean) [default: false]

#### gallery reactions (App\Models\GalleryReactions)
* id (unsigned big integer)
* gallery_image_id (unsigned big integer)
* reaction_id (unsigned big integer)
* user_id (unsigned big integer)
* session_id (unsigned big integer)

#### images (App\Models\Image)
* id (unsigned big integer)
* disk (string)
* file (string)
* hash (string)

#### module images (App\Modules\ModuleImage)
* id (unsigned big integer)
* module_id (unsigned big integer)
* image_id (unsigned big integer)

#### module parameters (App\Models\ModuleParameter)
* id (unsigned big integer)
* module_id (unsigned big integer)
* hash (string) [nullable]
* parameter (string)
* value (text)

#### modules (App\Models\Module)
* id (unsigned big integer)
* name (string)
* parameters (text)
* dynamic (boolean)
* examples (text) [nullable]
* component (string)
* edit_component (string) [nullable]

#### page modules (App\Models\PageModules)
* id (unsigned big integer)
* module_id (unsigned big integer)
* page_id (unsigned big integer)
* hash (string) [nullable]
* order (integer)
* enabled (boolean) [default: false]

#### page navigations (App\Models\PageNavigation)
* id (unsigned big integer)
* page_id (unsigned big integer)
* name (string) [nullable]
* enabled (boolean) [default: true]

#### page types (App\Model\PageType)
* id (unsigned big integer)
* name (string)

#### pages (App\Models\Page)
* id (unsigned big integer)
* type_id (unsigned big integer)
* title (string)
* slug (string)
* name (string)
* controller (string) [nullable]
* method (string) [nullable]
* publish_date (datetime)

#### reactions (App\Models\Reaction)
* id (unsigned big integer)
* reaction (string)
* icon (string)
* supported (boolean) [default: true]

#### settings (App\Models\Setting)
* id (unsigned big integer)
* key (string)
* value (text)

#### statistic devices (App\Models\StatisticDevice)
* id (unsigned big integer)
* session_id (string)
* browser (string)
* browser_version (string)
* platform (string)
* platform_version (string)
* device (string)
* desktop (boolean)
* mobile (boolean)
* mobile_bot (boolean)
* tablet (boolean)
* bot (boolean)
* robot (boolean)
* robot_name (string)
* languages (string)

#### statistic ip addresses (App\Models\StatisticIpAddress)
* id (unsigned big integer)
* session_id (string)
* ip_address (string)
* city (string) [nullable]
* region (string) [nullable]
* country (string) [nullable]
* country_code (string) [nullable]
* latitude (string) [nullable]
* longitude (string) [nullable]

#### statistic sessions (App\Models\StatisticSession)
* id (unsigned big integer)
* session_id (string)
* user_agent (text)

#### statistic views (App\Models\StatisticView)
* id (unsigned big integer)
* session_id (string)
* page_id (unsigned big integer)
* count (integer) [default:0]

#### users (App\User)
* id (unsigned big integer)
* name (string)
* email (string)
* email_verified_at (timestamp) [nullable]
* password (string)
* remember_token (string) [nullable]

### third party tables

#### laravel/laravel

##### failed_jobs (no model)
* id (unsigned big integer)
* uuid (string)
* connection (text)
* queue (text)
* payload (long text)
* exception (long text)
* failed_at (timestamp)

##### password resets (no model)
* email (string)
* token (string)

##### personal access tokens (no model)
* id (unsigned big integer)
* tokenable_type (string)
* tokenable_id (unsigned big integer)
* name (string)
* token (string)
* abilities (text) [nullable]
* last_used_at (timestamp) [nullable]

##### sessions (no model)
* id (string)
* user_id (unsigned big integer) [nullable]
* ip_address (string) [nullable]
* user_agent (text) [nullable]
* payload (text)
* last_activity (integer)

#### laravel/telescope

##### telescope entries (no model)
* sequence (unsigned big integer)
* uuid (char 36)
* batch_id (char 36)
* family_hash (string) [nullable]
* should_display_on_index (boolean) [default:true]
* type (string)
* content (longtext)

##### telescope entries tags (no model)
* entry_uuid (char 36)
* tag (string)

##### telescope monitoring (no model)
* tag (string)

## packages
* tailwindcss/tailwindui
* laravel
* breeze
* telescope
* [doctrine/dbal](https://github.com/doctrine/dbal)
* [propaganistas/laravel-phone](https://github.com/propaganistas/laravel-phone)
* [spatie/emoji](https://github.com/spatie/emoji)
* [adrianorosa/laravel-geolocation](https://github.com/adrianorsouza/laravel-geolocation)
* [jenssegers/agent](https://github.com/jenssegers/agent)
* [patoui/laravel-bad-word](https://github.com/patoui/laravel-bad-word)

### look into
* [spatie/laravel-demo-mode](https://github.com/spatie/laravel-demo-mode)
* [spatie/laravel-backup](https://github.com/spatie/laravel-backup)
* [spatie/laravel-activitylog](https://github.com/spatie/laravel-activitylog)
* [spatie/laravel-markdown](https://github.com/spatie/laravel-markdown)
* [spatie/laravel-medialibrary](https://github.com/spatie/laravel-medialibrary)
* [pragmarx/tracker](https://github.com/mikha-dev/pragmarx-tracker) **not used as its quite old, and not actively maintained**
* [wire-elements/modal](https://github.com/wire-elements/modal)
