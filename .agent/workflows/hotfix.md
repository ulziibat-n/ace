---
description: Perform a git flow hotfix following SemVer
---

// turbo-all

# Git Flow Hotfix Workflow

This workflow automates the process of creating a hotfix using `git-flow`, updating the version in `tailwind/custom/file-header.css`, building the production assets, and finishing the hotfix.

## Steps

0. **Pre-release Check (Linting)**
   Ensure the code is valid before starting the hotfix.

    ```bash
    npm run lint
    ```

1. **Prepare Master Branch**
   Ensure `master` branch is up to date.

    ```bash
    git checkout master
    git pull origin master
    ```

2. **Determine Hotfix Version (SemVer PATCH)**
   Read `tailwind/custom/file-header.css` to find the current version.
   According to SemVer, a hotfix MUST increment the **PATCH** version (e.g., `0.1.0` -> `0.1.1`).
   Confirm the target version with the user.

3. **Start Git Flow Hotfix**

    ```bash
    git flow hotfix start <version>
    ```

4. **Update Version in File**
   Update the `Version:` line in `tailwind/custom/file-header.css`.

5. **Update CHANGELOG.md (Mongolian)**
   Record the hotfix details in Mongolian.
    - Example: `#### Засагдсан алдаанууд` (Fixed bugs).

6. **Build Production Assets**

    ```bash
    npm run bundle
    ```

7. **Commit Hotfix Changes**

    ```bash
    git add .
    git commit -m "fix: bump version to <version>, update CHANGELOG and build assets for hotfix"
    ```

8. **Finish Hotfix with Notes**
   Merge the hotfix and create a tag with Mongolian details.

    ```bash
    git flow hotfix finish -m "Hotfix <version>: <Mongolian description of the fix>" <version>
    ```

9. **Push All Changes**

    ```bash
    git push origin master
    git push origin develop
    git push origin --tags
    ```

10. **Cleanup**
    Ensure we are back on `develop`.
    ```bash
    git checkout develop
    ```
