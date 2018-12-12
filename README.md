# Composer-based DDEV TYPO3 Multidomain Setup and Surf Deployment

_by phifa_

## TLDR:

`composer create-project phifa/typo3stack=dev-master --prefer-dist .`

## Notes

- During the installation several external extensions are installed. Additionally two local extensions are installed `template` and `template_site1`.
- The `template` extension is the Base and should not be changed at all.
- Every root site in the pagetree can get its own child template `template_site1`, `template_site2`, ...
- First perform installation below. Customization will be done afterwards during integration below.
- For multi-domain setup, copy the child extension and repeat integration for each domain.
- **Overwriting:** All overwriting is done in the child extension: You can hide the standard Backend Layouts, add your own or overwrite them, same is true for FLUID files, etc. In `page.typoscript` you can overwrite the `css` and the `js` files with your own files, etc. When overwriting, make sure to stick to naming conventions, as only the same name will overwrite.

## 1. Installation

1. Create your project folder and cd into it. Then: `composer create-project phifa/typo3stack=dev-master --prefer-dist .`
1. Copy configuration templates from `/presets/` to their place, customize and rename if neccessary.
1. Run `ddev start` or modify the ddev configuration first (e.g. change the name)
1. Modify `.env-example` in project root accordingly and rename to `.env`. File is in shipped `.gitignore` and should be created for each context.
1. Run `ddev ssh`, then `./post-create-project-cmd.sh`.
1. `exit` ssh session.
1. Log in to the Backend and add the admin user to the Admin Group (Page UIDs should become visible in the pagetree after page refresh).
1. Also double check under the module `Access`, that all pages point to the group: `[ACCESS] Default`, if not already the case.
1. Now template_site1 template is up and running. For customization see below **Integration**

If the the name of the DDEV container was not changed, these are the urls:

```
Frontend:
http://template.ddev.local
https://template.ddev.local
http://127.0.0.1:32775

MailHog:
http://template.ddev.local:8025

phpMyAdmin:
http://template.ddev.local:8036
```

## 2. Integration

1. Run `./renameextension.sh` and double check in changelog which files got changed.
1. Now the child template needs to be added again in two places in the backend: Add the TypoScript Template and the TSconfig to the Root Page. You might have to set the Backend Layout (and Sublevels) to `Test` again on the Root Page.
1. Modify constants of the child template accordingly. `config.name`, etc.
1. Clear System Caches and open your dev site, e.g. `http://mydomain.localhost`. Voila!

## 3. Deployment via Bitbucket Pipeline and Surf

1. Make sure Git is set up correctly for your project and origin is set to the Bitbucket Repository.
1. There should be a Master Branch that will deploy to the client's live site and a Staging Branch that will deploy to the client's stage subdomain
1. You only need to customize the configuration in `.surf/`. The files are called in `bitbucket-pipelines.yml`
