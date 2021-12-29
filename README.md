# simple-cms

this application is intended to help with personal website management. it will provide a variety of functionality to aid in setting up a simplistic website that contains a variety of information about a person and their respective interests.

## installation

### docker

### non-docker

## upgrade

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
    5. mass import command
3. resume builder
4. storage management
5. viewer analytics
    1. http agent
    2. page loads
    3. unique views
    4. click tracking (in theory)
6. settings
    1. toggle maintenance mode
    2. configure security
    3. laravel configuration management
        * website name
        * disk locations (view only)
        * database configuration (view only)
        * cors management
        * authentication management
            * password timeout
            * lockout durations
        * search engine indexing
7. permissions
   1. roles
   2. permissions

## permissions
all of the permissions that exist, their purposes and locations used in code. this is intended to help with managing and updating the permissions that are attached to each role in the application. **keep in mind this documentation is updated manually, and might be semi out of date.**

### photo grid permissions
* add photo
    * the "add photo" permission is intended to restrict who can add a photo to any of the photo grids.
* edit photo
    * the "edit photo" permission is intended to restrict who can edit a photo in any of the photo grids.
* delete photo
    * the "delete photo" permission is intended to restrict who can delete a photo from any of the photo grids.
* react to photo
    * the "react to photo" permission is intended to restrict who can add a reaction to any photo within a photo grid.
* comment on photo
    * the "comment on photo" permission is intended to restrict who can add a comment on any photo.
* view photo analytics
    * the "view photo analytics" permission is intended to restrict who can view the analytics for any photo grid.

### module permissions (excluding photo grid)
* edit (module)
    * the "edit (module)" permission is intended to restrict who can edit a specific module.
* delete (module)
    * the "delete (module)" permission is intended to restrict who can remove a module from a page.
* view (module)
    * the "view (module)" permission is intended to restrict who can view draft versions of modules on any linked pages.
* reorder (module)
    * the "reorder (module)" permission is intended to restrict who can change the order of a module on any page.

### analytics permissions
* view site analytics
    * the "view site analytics" permission is intended to restrict who can view the application analytics, [at this point mainly just page views].

### configuration slideover permissions
* view application information
    * the "view application information" permission is intended to restrict who can view the configuration information stored within laravel about the application.
* view logging information
    * the "view logging information" permission is intended to restrict who can view the configuration information stored within laravel about the methods in which logs are collected and handled.
* view database information
    * the "view database information" permission is intended to restrict who can view the configuration information stored within laravel about the database connection.
* view driver information
    * the "view driver information" permission is intended to restrict who can view the configuration information stored within laravel about the various drivers that the application __may__ use.
* view memcached information
    * the "view memcached information" permission is intended to restrict who can view the configuration information stored within laravel about the memcached server connection.
* view redis information
    * the "view redis information" permission is intended to restrict who can view the configuration information stored within laravel about the redis server connection.
* view mail information
    * the "view mail information" permission is intended to restrict who can view the configuration information stored within laravel about the email connection.
* view misc information
    * the "view misc information" permission is intended to restrict who can view the information stored within laravel about various settings that do not easily fit into another category.
* view file system information
    * the "view file system information" permission is intended to restrict who can view the information stored within laravel about the file system settings.

### email/contact slideover permissions
* view emails
    * the "view emails" permission is intended to restrict who can view contacts within the contact overlay when logged in.
* read emails
    * the "read emails" permission is intended to restrict who can mark an email as read within the contact overlay, this permission will only take effect when "view emails" is also enabled for a user.

### settings slideover permissions
* view maintenance settings
    * the "view maintenance settings" permission is intended to restict who can see the maintenance mode in the settings overlay. 
* update maintenance settings
    * the "update maintenance settings" permission is intended to restrict who can put the application into maintenance mode, this permission will only take effect when "update maintenance settings" is also enabled for a user.
* view logo settings
    * the "view logo settings" permission is intended to restrict who can see the logo upload form in the settings overlay.
* update logo settings
    * the "update logo settings" permisison is intended to restrict who can upload an image to the logo form in the settings overlay, this permission will only take effect when "view logo settings" is also enabled for a user.
* view name settings
    * the "view name settings" permission is intended to restrict who can view the application name in the settings overlay.
* update name settings
    * the "update name settings" permission is intended to restrict who can edit the application name in the settings overlay, this permission will only take effect when "view name settings" is also enabled for a user.
* view contact settings
* update contact settings
* view gallery settings
* update gallery settings
* view footer settings
* update footer settings

### comment moderation permissions
* remove comment
* update comment

### telescope permissions
* access telescope

### access control permissions
* view access controls
* add roles
* delete roles
* update roles
* associate permissions

### banner permissions
* add page
* delete page
* edit menu
* delete menu
* add module
* add gallery

## roles
all of the permissions assigned to each of the roles.

### administrator
* all of the permissions

### editor
* work in progress

### moderator
* work in progress

### photographer
* work in progress

### blogger
* work in progress

### user
* react to comment
* comment on photo

## data structures
all the tables should be assumed to have a created_at and updated_at timestamp without it being specified in the data structures listed below. additionally, all parent models (ie models that are related to other models but are the source of a foreign key) will be updated when a child model is updated however they will not be deleted if the child is deleted. **keep in mind this documentation is updated manually, and might be semi out of date.**

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

#### spatie/permission

##### permission (Spatie\Permission\Models\Permission)
* id (unsigned big integer)
* name (string)
* guard_name (string)

##### role (Spatie\Permission\Models\Role)
* id (unsigned big integer)
* name (string)
* guard_name (string)

##### role_has_permissions (no model)
* permission_id (unsigned big integer)
* role_id (unsigned big integer)

##### user_has_permissions (no model)
* permission_id (unsigned big integer)
* model_type (string)
* user_id (unsigned big integer)

##### user_has_roles (no model)
* role_id (unsigned big integer)
* model_type (string)
* user_id (unsigned big integer)

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
* [spatie/laravel-permission](https://github.com/spatie/laravel-permission)

### look into
* [spatie/laravel-demo-mode](https://github.com/spatie/laravel-demo-mode)
* [spatie/laravel-backup](https://github.com/spatie/laravel-backup)
* [spatie/laravel-activitylog](https://github.com/spatie/laravel-activitylog)
* [spatie/laravel-markdown](https://github.com/spatie/laravel-markdown)
* [spatie/laravel-medialibrary](https://github.com/spatie/laravel-medialibrary)
* [pragmarx/tracker](https://github.com/mikha-dev/pragmarx-tracker) **not used as its quite old, and not actively maintained**
* [wire-elements/modal](https://github.com/wire-elements/modal)
