<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\CoursesController;
use App\Http\Controllers\Admin\LessonsController;
use App\Http\Controllers\Admin\TestsController;
use App\Http\Controllers\Admin\QuestionsController;
use App\Http\Controllers\Admin\QuestionOptionsController;
use App\Http\Controllers\Admin\TestResultsController;
use App\Http\Controllers\Admin\TestAnswersController;
use App\Http\Controllers\Admin\FaqCategoryController;
use App\Http\Controllers\Admin\FaqQuestionController;
use App\Http\Controllers\Admin\ContactCompanyController;
use App\Http\Controllers\Admin\ContactContactsController;

use App\Http\Controllers\Frontend\HomeController as FrontendHomeController;
use App\Http\Controllers\Frontend\PermissionsController as FrontendPermissionsController;
use App\Http\Controllers\Frontend\RolesController as FrontendRolesController;
use App\Http\Controllers\Frontend\UsersController as FrontendUsersController;
use App\Http\Controllers\Frontend\CoursesController as FrontendCoursesController;
use App\Http\Controllers\Frontend\LessonsController as FrontendLessonsController;
use App\Http\Controllers\Frontend\TestsController as FrontendTestsController;
use App\Http\Controllers\Frontend\QuestionsController as FrontendQuestionsController;
use App\Http\Controllers\Frontend\QuestionOptionsController as FrontendQuestionOptionsController;
use App\Http\Controllers\Frontend\TestResultsController as FrontendTestResultsController;
use App\Http\Controllers\Frontend\TestAnswersController as FrontendTestAnswersController;
use App\Http\Controllers\Frontend\FaqCategoryController as FrontendFaqCategoryController;
use App\Http\Controllers\Frontend\FaqQuestionController as FrontendFaqQuestionController;
use App\Http\Controllers\Frontend\ContactCompanyController as FrontendContactCompanyController;
use App\Http\Controllers\Frontend\ContactContactsController as FrontendContactContactsController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Admin\UserControllers;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseEnrollmentController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\Frontend\InstructorController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\FaqController;

Route::redirect('/', '/frontend/home');

Route::group(['prefix' => 'frontend', 'as' => 'frontend.', 'namespace' => 'App\Http\Controllers\Frontend'], function () {
    // Public routes
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/about', [ContactController::class, 'about'])->name('about');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
    
    // Protected routes
    Route::middleware(['auth'])->group(function () {
        // Courses
        Route::resource('courses', 'CoursesController');

        // Lessons
        Route::resource('lessons', 'LessonsController');

        // Tests
        Route::resource('tests', 'TestsController');

        // Questions
        Route::resource('questions', 'QuestionsController');

        // Question Options
        Route::resource('question-options', 'QuestionOptionsController');

        // Test Results
        Route::resource('test-results', 'TestResultsController');

        // Test Answers
        Route::resource('test-answers', 'TestAnswersController');

        // FAQ Categories
        Route::resource('faq-categories', 'FaqCategoryController');

        // FAQ Questions
        Route::resource('faq-questions', 'FaqQuestionController');

        // Users
        Route::resource('users', 'UsersController');

        // Roles
        Route::resource('roles', 'RolesController');

        // Permissions
        Route::resource('permissions', 'PermissionsController');

        // Profile
        Route::get('profile', 'ProfileController@index')->name('profile.index');
        Route::post('profile', 'ProfileController@update')->name('profile.update');
        Route::post('profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
        Route::post('profile/password', 'ProfileController@password')->name('profile.password');

        // Contact Companies
        Route::resource('contact-companies', 'ContactCompanyController');

        // Contact Contacts
        Route::resource('contact-contacts', 'ContactContactsController');

        // Mass Delete Routes
        Route::delete('courses/destroy', 'CoursesController@massDestroy')->name('courses.massDestroy');
        Route::delete('lessons/destroy', 'LessonsController@massDestroy')->name('lessons.massDestroy');
        Route::delete('tests/destroy', 'TestsController@massDestroy')->name('tests.massDestroy');
        Route::delete('questions/destroy', 'QuestionsController@massDestroy')->name('questions.massDestroy');
        Route::delete('question-options/destroy', 'QuestionOptionsController@massDestroy')->name('question-options.massDestroy');
        Route::delete('test-results/destroy', 'TestResultsController@massDestroy')->name('test-results.massDestroy');
        Route::delete('test-answers/destroy', 'TestAnswersController@massDestroy')->name('test-answers.massDestroy');
        Route::delete('faq-categories/destroy', 'FaqCategoryController@massDestroy')->name('faq-categories.massDestroy');
        Route::delete('faq-questions/destroy', 'FaqQuestionController@massDestroy')->name('faq-questions.massDestroy');
        Route::delete('contact-companies/destroy', 'ContactCompanyController@massDestroy')->name('contact-companies.massDestroy');
        Route::delete('contact-contacts/destroy', 'ContactContactsController@massDestroy')->name('contact-contacts.massDestroy');
        Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
        Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
        Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');

        // Media Upload Routes
        Route::post('courses/media', 'CoursesController@storeMedia')->name('courses.storeMedia');
        Route::post('lessons/media', 'LessonsController@storeMedia')->name('lessons.storeMedia');
        Route::post('questions/media', 'QuestionsController@storeMedia')->name('questions.storeMedia');
        Route::post('courses/ckmedia', 'CoursesController@storeCKEditorImages')->name('courses.storeCKEditorImages');
        Route::post('lessons/ckmedia', 'LessonsController@storeCKEditorImages')->name('lessons.storeCKEditorImages');
        Route::post('questions/ckmedia', 'QuestionsController@storeCKEditorImages')->name('questions.storeCKEditorImages');
    });
});

// API Routes for dynamic data
Route::middleware(['auth'])->group(function () {
    Route::prefix('api')->group(function () {
        Route::get('course-lessons/{course}', function ($course) {
            return App\Models\Course::findOrFail($course)
                ->lessons()
                ->pluck('title', 'id');
        });
    });
});

// Auth routes
Auth::routes();

// Public Routes (add this before the admin routes)
Route::group(['as' => 'courses.'], function () {
    Route::get('/courses', [FrontendCoursesController::class, 'index'])->name('index');
    Route::get('/courses/create', [FrontendCoursesController::class, 'create'])->name('create');
    Route::post('/courses', [FrontendCoursesController::class, 'store'])->name('store');
    Route::get('/courses/{course}', [FrontendCoursesController::class, 'show'])->name('show');
});

// Admin Routes
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', [AdminHomeController::class, 'index'])->name('home');

    // Permissions
    Route::delete('permissions/destroy', [PermissionsController::class, 'massDestroy'])->name('permissions.massDestroy');
    Route::post('permissions/parse-csv-import', [PermissionsController::class, 'parseCsvImport'])->name('permissions.parseCsvImport');
    Route::post('permissions/process-csv-import', [PermissionsController::class, 'processCsvImport'])->name('permissions.processCsvImport');
    Route::resource('permissions', PermissionsController::class);

    // Roles
    Route::delete('roles/destroy', [RolesController::class, 'massDestroy'])->name('roles.massDestroy');
    Route::post('roles/parse-csv-import', [RolesController::class, 'parseCsvImport'])->name('roles.parseCsvImport');
    Route::post('roles/process-csv-import', [RolesController::class, 'processCsvImport'])->name('roles.processCsvImport');
    Route::resource('roles', RolesController::class);

    // Users
    Route::delete('users/destroy', [UsersController::class, 'massDestroy'])->name('users.massDestroy');
    Route::post('users/parse-csv-import', [UsersController::class, 'parseCsvImport'])->name('users.parseCsvImport');
    Route::post('users/process-csv-import', [UsersController::class, 'processCsvImport'])->name('users.processCsvImport');
    Route::resource('users', UsersController::class);

    // Courses
    Route::delete('courses/destroy', [CoursesController::class, 'massDestroy'])->name('courses.massDestroy');
    Route::post('courses/media', [CoursesController::class, 'storeMedia'])->name('courses.storeMedia');
    Route::post('courses/ckmedia', [CoursesController::class, 'storeCKEditorImages'])->name('courses.storeCKEditorImages');
    Route::post('courses/parse-csv-import', [CoursesController::class, 'parseCsvImport'])->name('courses.parseCsvImport');
    Route::post('courses/process-csv-import', [CoursesController::class, 'processCsvImport'])->name('courses.processCsvImport');
    Route::resource('courses', CoursesController::class);

    // Lessons
    Route::delete('lessons/destroy', [LessonsController::class, 'massDestroy'])->name('lessons.massDestroy');
    Route::post('lessons/media', [LessonsController::class, 'storeMedia'])->name('lessons.storeMedia');
    Route::post('lessons/ckmedia', [LessonsController::class, 'storeCKEditorImages'])->name('lessons.storeCKEditorImages');
    Route::post('lessons/parse-csv-import', [LessonsController::class, 'parseCsvImport'])->name('lessons.parseCsvImport');
    Route::post('lessons/process-csv-import', [LessonsController::class, 'processCsvImport'])->name('lessons.processCsvImport');
    Route::resource('lessons', LessonsController::class);

    // Tests
    Route::delete('tests/destroy', [TestsController::class, 'massDestroy'])->name('tests.massDestroy');
    Route::post('tests/parse-csv-import', [TestsController::class, 'parseCsvImport'])->name('tests.parseCsvImport');
    Route::post('tests/process-csv-import', [TestsController::class, 'processCsvImport'])->name('tests.processCsvImport');
    Route::resource('tests', TestsController::class);

    // Questions
    Route::delete('questions/destroy', [QuestionsController::class, 'massDestroy'])->name('questions.massDestroy');
    Route::post('questions/media', [QuestionsController::class, 'storeMedia'])->name('questions.storeMedia');
    Route::post('questions/ckmedia', [QuestionsController::class, 'storeCKEditorImages'])->name('questions.storeCKEditorImages');
    Route::post('questions/parse-csv-import', [QuestionsController::class, 'parseCsvImport'])->name('questions.parseCsvImport');
    Route::post('questions/process-csv-import', [QuestionsController::class, 'processCsvImport'])->name('questions.processCsvImport');
    Route::resource('questions', QuestionsController::class);

    // Question Options
    Route::delete('question-options/destroy', [QuestionOptionsController::class, 'massDestroy'])->name('question-options.massDestroy');
    Route::post('question-options/parse-csv-import', [QuestionOptionsController::class, 'parseCsvImport'])->name('question-options.parseCsvImport');
    Route::post('question-options/process-csv-import', [QuestionOptionsController::class, 'processCsvImport'])->name('question-options.processCsvImport');
    Route::resource('question-options', QuestionOptionsController::class);

    // Test Results
    Route::delete('test-results/destroy', [TestResultsController::class, 'massDestroy'])->name('test-results.massDestroy');
    Route::post('test-results/parse-csv-import', [TestResultsController::class, 'parseCsvImport'])->name('test-results.parseCsvImport');
    Route::post('test-results/process-csv-import', [TestResultsController::class, 'processCsvImport'])->name('test-results.processCsvImport');
    Route::resource('test-results', TestResultsController::class);

    // Test Answers
    Route::delete('test-answers/destroy', [TestAnswersController::class, 'massDestroy'])->name('test-answers.massDestroy');
    Route::post('test-answers/parse-csv-import', [TestAnswersController::class, 'parseCsvImport'])->name('test-answers.parseCsvImport');
    Route::post('test-answers/process-csv-import', [TestAnswersController::class, 'processCsvImport'])->name('test-answers.processCsvImport');
    Route::resource('test-answers', TestAnswersController::class);

    // Faq Category
    Route::delete('faq-categories/destroy', [FaqCategoryController::class, 'massDestroy'])->name('faq-categories.massDestroy');
    Route::post('faq-categories/parse-csv-import', [FaqCategoryController::class, 'parseCsvImport'])->name('faq-categories.parseCsvImport');
    Route::post('faq-categories/process-csv-import', [FaqCategoryController::class, 'processCsvImport'])->name('faq-categories.processCsvImport');
    Route::resource('faq-categories', FaqCategoryController::class);

    // Faq Question
    Route::delete('faq-questions/destroy', [FaqQuestionController::class, 'massDestroy'])->name('faq-questions.massDestroy');
    Route::post('faq-questions/parse-csv-import', [FaqQuestionController::class, 'parseCsvImport'])->name('faq-questions.parseCsvImport');
    Route::post('faq-questions/process-csv-import', [FaqQuestionController::class, 'processCsvImport'])->name('faq-questions.processCsvImport');
    Route::resource('faq-questions', FaqQuestionController::class);

    // Contact Company
    Route::delete('contact-companies/destroy', [ContactCompanyController::class, 'massDestroy'])->name('contact-companies.massDestroy');
    Route::resource('contact-companies', ContactCompanyController::class);

    // Contact Contacts
    Route::delete('contact-contacts/destroy', [ContactContactsController::class, 'massDestroy'])->name('contact-contacts.massDestroy');
    Route::resource('contact-contacts', ContactContactsController::class);
});

// Profile Routes
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', [ChangePasswordController::class, 'edit'])->name('password.edit');
        Route::post('password', [ChangePasswordController::class, 'update'])->name('password.update');
        Route::post('profile', [ChangePasswordController::class, 'updateProfile'])->name('password.updateProfile');
        Route::post('profile/destroy', [ChangePasswordController::class, 'destroy'])->name('password.destroyProfile');
    }
});

Route::resource('users', UsersController::class);

// Course Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');
    Route::get('/courses/{course}/enroll', [CourseEnrollmentController::class, 'create'])->name('courses.enroll');
    Route::post('/courses/{course}/enroll', [CourseEnrollmentController::class, 'store'])->name('courses.enroll.store');
    
    // Protected routes (only for enrolled students)
    Route::middleware(['enrolled'])->group(function () {
        Route::get('/lessons/{lesson}', [LessonController::class, 'show'])->name('lessons.show');
    });
});

Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

Route::get('/instructors', [InstructorController::class, 'index'])->name('frontend.instructors.index');

Route::get('/faq', [FaqController::class, 'index'])->name('frontend.faq');
