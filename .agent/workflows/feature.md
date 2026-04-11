---
description: Manage git flow features
---

// turbo-all

# Git Flow Feature Workflow

This workflow helps in starting and finishing features using `git-flow`.

## Start a Feature

1. **Pull Latest Changes**

    ```bash
    git checkout develop
    git pull origin develop
    ```

2. **Start Feature**
   Ask the user for the feature name if not provided. Use lowercase and hyphens (e.g., `header-cleanup`).

    ```bash
    git flow feature start <feature-name>
    ```

3. **Confirmation**
   Inform the user that the feature branch is ready for development.

---

## Finish a Feature

1. **Lint Check**
   Always check the code before merging.

    ```bash
    npm run lint
    ```

2. **Commit Changes**
   Ensure all changes are committed with a meaningful message (preferably following Conventional Commits).

    ```bash
    git add .
    git commit -m "feat: <description>"
    ```

3. **Finish Feature**
   Merge the feature branch back into `develop`.

    ```bash
    git flow feature finish <feature-name>
    ```

4. **Push to Develop**
    ```bash
    git push origin develop
    ```
