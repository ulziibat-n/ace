---
description: Perform a git flow release following SemVer
---

// turbo-all

# Git Flow Release Workflow

This workflow automates the process of creating a release using `git-flow`, updating the version in `tailwind/custom/file-header.css`, building the production assets, and finishing the release.

## Steps

0. **Pre-release Check (Linting)**
   Ensure the code follows the project standards before starting the release.

    ```bash
    npm run lint
    ```

    _If linting fails, the release process must stop here until fixed._

1. **Prepare Branches**
   Ensure both `master` and `develop` branches are up to date.

    ```bash
    git checkout master
    git pull origin master
    git checkout develop
    git pull origin develop
    ```

2. **Determine Version (SemVer 2.0.0)**
   Analysis of changes since the last version:
    - **MAJOR** version (X.y.z) for incompatible API changes.
    - **MINOR** version (x.Y.z) for new functionality in a backwards compatible manner.
    - **PATCH** version (x.y.Z) for backwards compatible bug fixes.
      Read the current version from `tailwind/custom/file-header.css` (e.g., `0.1.0`).
      Suggest the next version based on the commit history and confirm with the user.

3. **Start Git Flow Release**
   Initiate the release branch.

    ```bash
    git flow release start <version>
    ```

4. **Update Version in File**
   Update the `Version:` line in `tailwind/custom/file-header.css`.

5. **Update CHANGELOG.md (Mongolian)**
   Create or update `CHANGELOG.md` at the project root.
    - Add the new version and date.
    - List changes (features, fixes, improvements) in **Mongolian**.
    - Ensure the tone is professional and descriptive.
    - Example format: `### [X.Y.Z] - YYYY-MM-DD` / `#### Нэмэгдсэн өөрчлөлтүүд`.

6. **Build Production Assets**
   Generate the latest production bundle (includes production CSS/JS and ZIP).

    ```bash
    npm run bundle
    ```

7. **Commit Release Changes**
   Commit the version update, changelog, and build results.

    ```bash
    git add .
    git commit -m "chore: bump version to <version>, update CHANGELOG and build assets"
    ```

8. **Finish Release with Notes**
   Merge the release branch and create a tag with the Mongolian release notes.

    ```bash
    git flow release finish -m "Release <version>: <Mongolian summary>" <version>
    ```

9. **Push All Changes**
   Push branches and tags to the remote repository.

    ```bash
    git push origin master
    git push origin develop
    git push origin --tags
    ```

10. **Cleanup**
    Ensure we are on the `develop` branch.
    ```bash
    git checkout develop
    ```
