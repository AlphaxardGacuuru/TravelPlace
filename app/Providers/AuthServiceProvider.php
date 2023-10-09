<?php

namespace App\Providers;

use App\Models\Admin\Admin;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Create Gates
        Gate::define("read-dashboard-settings", fn(Admin $admin) => $this->check($admin, "dashboard_settings"));
        Gate::define("read-general-settings", fn(Admin $admin) => $this->check($admin, "general_settings"));
        Gate::define("read-page-settings", fn(Admin $admin) => $this->check($admin, "page_settings"));
        Gate::define("read-payment-settings", fn(Admin $admin) => $this->check($admin, "payment_settings"));
        Gate::define("read-blog-section", fn(Admin $admin) => $this->check($admin, "blog_section"));
        Gate::define("read-destinations", fn(Admin $admin) => $this->check($admin, "destinations"));
        Gate::define("read-packages", fn(Admin $admin) => $this->check($admin, "packages"));
        Gate::define("read-dynamic-pages", fn(Admin $admin) => $this->check($admin, "dynamic_pages"));
        Gate::define("read-language", fn(Admin $admin) => $this->check($admin, "language"));
        Gate::define("read-web-section", fn(Admin $admin) => $this->check($admin, "web_section"));
        Gate::define("read-order", fn(Admin $admin) => $this->check($admin, "order"));
        Gate::define("read-traveller", fn(Admin $admin) => $this->check($admin, "traveller"));
        Gate::define("read-email-template", fn(Admin $admin) => $this->check($admin, "email_template"));
        Gate::define("read-subscriber", fn(Admin $admin) => $this->check($admin, "subscriber"));
        Gate::define("read-staff", fn(Admin $admin) => $this->check($admin, "staff"));

        // Create Gates
        Gate::define("create-blog-section", fn(Admin $admin) => $admin->permissions()->contains("blog_section.create"));
        Gate::define("create-destinations", fn(Admin $admin) => $this->check($admin, "destinations.create"));
        Gate::define("create-packages", fn(Admin $admin) => $this->check($admin, "packages.create"));
        Gate::define("create-dynamic-pages", fn(Admin $admin) => $this->check($admin, "dynamic_pages.create"));
        Gate::define("create-web-section", fn(Admin $admin) => $this->check($admin, "web_section.create"));
        Gate::define("create-staff", fn(Admin $admin) => $this->check($admin, "staff.create"));

        // Update Gates
        Gate::define("update-general-settings", fn(Admin $admin) => $admin->permissions()->contains("general_settings.update"));
        Gate::define("update-page-settings", fn(Admin $admin) => $admin->permissions()->contains("page_settings.update"));
        Gate::define("update-payment-settings", fn(Admin $admin) => $admin->permissions()->contains("payment_settings.update"));
        Gate::define("update-blog-section", fn(Admin $admin) => $admin->permissions()->contains("blog_section.update"));
        Gate::define("update-destinations", fn(Admin $admin) => $this->check($admin, "destinations.update"));
        Gate::define("update-packages", fn(Admin $admin) => $this->check($admin, "packages.update"));
        Gate::define("update-dynamic-pages", fn(Admin $admin) => $this->check($admin, "dynamic_pages.update"));
        Gate::define("update-language", fn(Admin $admin) => $this->check($admin, "language.update"));
        Gate::define("update-web-section", fn(Admin $admin) => $this->check($admin, "web_section.update"));
        Gate::define("update-order", fn(Admin $admin) => $this->check($admin, "order.update"));
        Gate::define("update-traveller", fn(Admin $admin) => $this->check($admin, "traveller.update"));
        Gate::define("update-email-template", fn(Admin $admin) => $this->check($admin, "email_template.update"));
        Gate::define("update-staff", fn(Admin $admin) => $this->check($admin, "staff.update"));

        // Delete Gates
        Gate::define("delete-blog-section", fn(Admin $admin) => $admin->permissions()->contains("blog_section.delete"));
        Gate::define("delete-destinations", fn(Admin $admin) => $this->check($admin, "destinations.delete"));
        Gate::define("delete-packages", fn(Admin $admin) => $this->check($admin, "packages.delete"));
        Gate::define("delete-dynamic-pages", fn(Admin $admin) => $this->check($admin, "dynamic_pages.delete"));
        Gate::define("delete-web-section", fn(Admin $admin) => $this->check($admin, "web_section.delete"));
        Gate::define("delete-order", fn(Admin $admin) => $this->check($admin, "order.delete"));
        Gate::define("delete-traveller", fn(Admin $admin) => $this->check($admin, "traveller.delete"));
        Gate::define("delete-subscriber", fn(Admin $admin) => $this->check($admin, "subscriber.delete"));
        Gate::define("delete-staff", fn(Admin $admin) => $this->check($admin, "staff.delete"));
    }

    protected function check($admin, $entityName)
    {
        return $admin->permissions()
            ->contains(fn($entity) => str_contains($entity, $entityName));
    }
}
