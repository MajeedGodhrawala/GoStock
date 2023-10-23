function has_permission(name) {
    const permissions = JSON.parse(sessionStorage.getItem("user_permissions"));
    const has_permission = Object.values(permissions).includes(
        name
    );
    return has_permission;
}

//Export
export { has_permission };