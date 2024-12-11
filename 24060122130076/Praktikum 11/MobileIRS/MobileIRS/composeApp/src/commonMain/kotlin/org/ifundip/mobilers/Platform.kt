package org.ifundip.mobilers

interface Platform {
    val name: String
}

expect fun getPlatform(): Platform