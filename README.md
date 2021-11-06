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
    4. reactions (can be enabled or disabled)
3. resume builder
4. storage management
5. viewer analytics
    1. http agent
    2. page loads
    3. unique views
    4. click tracking
6. settings
    1. toggle mainanence mode
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
all of the tables should be assumed to have a created_at and updated_at timestamp without it being specified in the data structures listed below. additionally, all parent models (ie models that are related to other models but are the source of a foreign key) will be updated when a child model is updated however they will not be deleted if the child is deleted.

### pages (App\Models\Page)
* id (unsigned big integer)
* type_id (unsigned big integer)
* title (string)
* slug (string)
* controller (string) [nullable]
* method (string) [nullable]
* publish_date (datetime)

### page types (App\Model\PageType)
* id (unsigned big integer)
* name (string)

### page modules (App\Models\PageModules)
* id (unsigned big integer) 
* module_id (unsigned big integer)
* page_id (unsigned big integer)
* order (integer)
* enabled (boolean) [default: false]

### modules (App\Models\Module)
* id (unsigned big integer)
* name (string)
* parameters (text)
* examples (text) [nullable]
* component (string)

### module parameters (App\Models\ModuleParameter)
* id (unsigned big integer)
* module_id (unsigned big integer)
* parameter (string)
* value (text)

### module images (App\Modules\ModuleImage)
* id (unsigned big integer)
* module_id (unsigned big integer)
* image_id (unsigned big integer)

### images (App\Models\Image)
* id (unsigned big integer)
* disk (string)
* file (string)
* hash (string)

### reactions (App\Models\Reaction)
* id (unsigned big integer)
* reaction (string)
* icon (string)
* color (string)

### galleries (App\Models\Gallery)
* id (unsigned big integer)
* name (string)
* description (string)
* enabled (boolean) [default: false]

### gallery images (App\Models\GalleryImage)
* id (unsigned big integer)
* gallery_id (unsigned big integer)
* image_id (unsigned big integer)
* caption (string)
* location (text)
* people (text)
* visible (boolean) [default: false]

### gallery comments (App\Models\GalleryComment)
* id (unsigned big integer)
* gallery_image_id (unsigned big integer)
* user_id (unsigned big integer)
* session_id (unsigned big integer)
* message (text)

### gallery reactions (App\Models\GalleryReactions)
* id (unsigned big integer)
* gallery_image_id (unsigned big integer)
* reaction_id (unsigned big integer)
* user_id (unsigned big integer)
* session_id (unsigned big integer)

## packages
* tailwindcss/tailwindui
* laravel
* breeze
* telescope

### look into
* spatie/laravel-demo-mode
* spatie/laravel-backup
* spatie/laravel-activitylog
* spatie/laravel-markdown
* spatie/laravel-medialibrary
* pragmarx/tracker

