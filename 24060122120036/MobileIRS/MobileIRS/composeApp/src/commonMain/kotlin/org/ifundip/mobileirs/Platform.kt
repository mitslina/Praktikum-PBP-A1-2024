package org.ifundip.mobileirs

interface Platform {
    val name: String
}

expect fun getPlatform(): Platform