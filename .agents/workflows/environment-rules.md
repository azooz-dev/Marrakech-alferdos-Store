---
description: Environment-specific rules for this workspace (Laragon on Windows with WSL shell)
---

# Environment Rules

## Shell
- The terminal runs through **WSL** (Windows Subsystem for Linux).
- **Never use Windows-native commands:** `copy`, `move`, `del`, `dir`, `cmd.exe`, `type`.
- **Use Unix equivalents:** `cp`, `mv`, `rm`, `ls`, `cat`.
- Windows paths like `c:\foo\bar` must be converted to `/mnt/c/foo/bar` for shell commands.
- The `write_to_file` and `view_file` tools accept Windows paths — only terminal commands need WSL paths.

## Stack
- **WordPress** served by Laragon (Apache + PHP + MySQL).
- WordPress root: `c:\laragon\www\custom-theme`.
- WooCommerce plugin is pre-installed and active.
- Local dev URL: `http://custom-theme.test` (Laragon auto virtual host).

## File Operations
- Use `write_to_file` to create files (supports Windows paths).
- Use `view_file` to read files (supports Windows paths).
- For terminal file operations, always use WSL paths with `/mnt/c/`.
- The `run_command` tool's `Cwd` parameter DOES accept Windows paths like `c:\laragon\www\custom-theme`.
